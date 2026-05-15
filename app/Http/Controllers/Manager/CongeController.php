<?php
namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Conge;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class CongeController extends Controller
{
    public function index()
    {
        $manager     = Auth::user();
        dd($manager->id,$manager->name);
        $employesIds = $manager->employes()->pluck('id');
        dd($employesIds);
        if ($employesIds->isEmpty()) {
    // Méthode 2 : Recherche directe des employés qui ont ce manager_id
    $employesIds = User::where('manager_id', $manager->id)->pluck('id');
}

        $demandes    = Conge::whereIn('user_id', $employesIds)
            ->where('statut', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();
        dd($demandes);

        return view('manager.conge.index', compact('demandes'));
    }

    public function show($id)
    {
        $manager     = Auth::user();
        $employesIds = $manager->employes()->pluck('id');
        $demande     = Conge::whereIn('user_id', $employesIds)
            ->findOrFail($id);
        $congesSimultanes = Conge::whereIn('user_id', $employesIds)
            ->where('statut', 'approved')
            ->where(function ($query) use ($demande) {
                $query->whereBetween('date_debut', [$demande->date_debut, $demande->date_fin])
                    ->orWhereBetween('date_fin', [$demande->date_debut, $demande->date_fin]);
            })
            ->count();

        $totalEquipe       = $manager->employes()->count();
        $impactPourcentage = ($congesSimultanes / max($totalEquipe, 1)) * 100;

        return view('manager.conge.show', compact('demande', 'congesSimultanes', 'totalEquipe', 'impactPourcentage'));

    }

    public function accepter($id)
    {
        $manager     = Auth::user();
        $employesIds = $manager->employes()->pluck('id');

        $demande = Conge::whereIn('user_id', $employesIds)
            ->where('statut', 'pending')
            ->findOrFail($id);

        $demande->update([
            'statut'          => 'approved',
            'valide_par'      => $manager->id,
            'date_validation' => now(),
        ]);

        $employe = $demande->user;
        $duree   = $demande->date_debut->diffInDays($demande->date_fin) + 1;
        $employe->decrement('conges_restants', $duree);

        // Mail::to($employe->email)->send(new CongeAccepter($demande));
        return redirect()->route('manager.conges.index')
            ->with('success', 'Congé accepteé' . $duree . 'jours on été supprimé de vots conges restants');

    }
    public function refuser(Request $request, $id)
    {
        $request->validate([
            'motif_refus' => 'required|string|min:3|max:500',
        ]);

        $manager     = Auth::user();
        $employesIds = $manager->employes()->pluck('id');

        $demande = Conge::whereIn('user_id', $employesIds)
            ->where('statut', 'pending')
            ->findOrFail($id);

        // Mettre à jour la demande
        $demande->update([
            'statut'              => 'refused',
            'valide_par'          => $manager->id,
            'commentaire_manager' => $request->motif_refus,
            'date_validation'     => now(),
        ]);


        return redirect()->route('manager.conges.index')
            ->with('error', 'Congé refusé. Motif enregistré.');
    }
}
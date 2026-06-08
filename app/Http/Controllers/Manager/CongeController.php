<?php
namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Conge;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CongeController extends Controller
{
    // Methode index:
    public function index()
    {
        $manager = Auth::user();

        $employes = User::where('manager_id', $manager->id)->get();

        $employesIds = $manager->employes()->pluck('id');

        if ($employesIds->isEmpty()) {
            $employesIds = User::where('manager_id', $manager->id)->pluck('id');
        }

        $demandes = Conge::whereIn('user_id', $employesIds)
            ->where('statut', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('manager.conge.index', compact('demandes'));
    }

    // Methode show:
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

    // Methode accepter
    public function accepter($id)
    {
        $manager     = Auth::user();
        $employesIds = $manager->employes()->pluck('id');

    $demande = Conge::whereIn('user_id', $employesIds)
        ->where('statut', 'pending')
        ->findOrFail($id);

    $duree = $demande->duree;

    if ($demande->isPaye()) {
        $employe = $demande->user;
        $employe->decrement('conges_restants', $duree);
    }

    $demande->update([
        'statut'          => 'approved',
        'valide_par'      => $manager->id,
        'date_validation' => now(),
    ]);

    return redirect()->route('manager.conges.index')
        ->with('success', 'Congé accepté. ' . $duree . ' jour déduits du solde de ' . $demande->user->name);
}

    // Methode refuser:
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

        $demande->update([
            'statut'              => 'refused',
            'valide_par'          => $manager->id,
            'commentaire_manager' => $request->motif_refus,
            'date_validation'     => now(),
        ]);

        return redirect()->route('manager.conges.index')
            ->with('success', 'Congé refusé. Motif enregistré.');
    }
}
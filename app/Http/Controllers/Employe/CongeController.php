<?php
namespace App\Http\Controllers\Employe;

use App\Http\Controllers\Controller;
use App\Models\Conge;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CongeController extends Controller
{

    public function create()
    {
        $user           = Auth::user();
        $congesRestants = $user->conges_restants;
        return view('employe.conge.create', compact('congesRestants'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'type'       => 'required|in:vacances,maladie,personnel,formation',
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin'   => 'required|date|after_or_equal:date_debut',
            'motif'      => 'required|string|max:500',
        ]);

        $debut = new DateTime($request->date_debut);
        $fin   = new DateTime($request->date_fin);
        $duree = $debut->diff($fin)->days + 1;

        if ($duree > $user->conges_restants) {
            return back()->with('error', 'solde de congés insuffisant pour cette demande');
        }

        $conge = Conge::create([
            'user_id'    => $user->id,
            'date_debut' => $request->date_debut,
            'date_fin'   => $request->date_fin,
            'type'       => $request->type,
            'statut'     => 'pending',
            'motif'      => $request->motif,
        ]);

        return redirect()->route('employe.dashboard')
            ->with('success', 'Demande de congé envoyée en attente de validation');
    }

    public function index()
    {
        $user = Auth::user();

        if ($user->isManager()) {
            // Afficher les congés des employés du manager
            $employeIds = $user->employes()->pluck('id');
            $conges     = Conge::whereIn('user_id', $employeIds)
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            // Afficher les propres congés de l'employé
            $conges = $user->conges()->orderBy('created_at', 'desc')->get();
        }

        return view('employe.conge.index', compact('conges'));
    }

    public function show($id)
    {
        $user = Auth::user();

        if ($user->isManager()) {
            // Manager peut voir les congés de ses employés
            $employeIds = $user->employes()->pluck('id');
            $conge      = Conge::where('id', $id)
                ->whereIn('user_id', $employeIds)
                ->firstOrFail();
        } else {
            // Employé peut voir seulement ses propres congés
            $conge = Conge::where('id', $id)->where('user_id', $user->id)->firstOrFail();
        }

        return view('employe.conge.show', compact('conge'));
    }

    public function accepter($id)
    {
        $user = Auth::user();

        if (! $user->isManager()) {
            abort(403, 'Non autorisé');
        }

        $employeIds = $user->employes()->pluck('id');
        $conge      = Conge::where('id', $id)
            ->whereIn('user_id', $employeIds)
            ->firstOrFail();

        $conge->update([
            'statut'     => 'approved',
            'valide_par' => $user->id,
        ]);

        return redirect()->route('manager.conges.index')
            ->with('success', 'Congé approuvé avec succès');
    }

    public function refuser(Request $request, $id)
    {
        $user = Auth::user();

        if (! $user->isManager()) {
            abort(403, 'Non autorisé');
        }

        $employeIds = $user->employes()->pluck('id');
        $conge      = Conge::where('id', $id)
            ->whereIn('user_id', $employeIds)
            ->firstOrFail();

        $request->validate([
            'motif' => 'required|string|max:500',
        ]);

        $conge->update([
            'statut'              => 'refused',
            'commentaire_manager' => $request->motif,
            'valide_par'          => $user->id,
        ]);

        return redirect()->route('manager.conges.index')
            ->with('success', 'Congé refusé avec succès');
    }

    public function annuler($id)
    {
        $user = Auth::user();

        if (! $user->isEmploye()) {
            abort(403, 'Non autorisé');
        }

        $conge = Conge::where('id', $id)->where('user_id', $user->id)->firstOrFail();

        if ($conge->statut !== 'pending') {
            return back()->with('error', 'Seules les demandes en attente peuvent être annulées');
        }

        $conge->delete();

        return redirect()->route('employe.conge.index')
            ->with('success', 'Demande de congé annulée avec succès');
    }
}
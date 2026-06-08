<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Deplacement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DeplacementController extends Controller
{
    /**
     * Liste des déplacements en attente
     */
    public function index()
    {
        $manager = Auth::user();
        $employesIds = $manager->employes()->pluck('id');

        $deplacements = Deplacement::whereIn('user_id', $employesIds)
            ->where('statut', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('manager.deplacement.index', compact('deplacements'));
    }

    /**
     * Détail d'un déplacement
     */
    public function show($id)
    {
        $manager = Auth::user();
        $employesIds = $manager->employes()->pluck('id');

        $deplacement = Deplacement::whereIn('user_id', $employesIds)->findOrFail($id);

        return view('manager.deplacement.show', compact('deplacement'));
    }

    /**
     * Accepter un déplacement
     */
    public function accepter($id)
    {
        $manager = Auth::user();
        $employesIds = $manager->employes()->pluck('id');

        $deplacement = Deplacement::whereIn('user_id', $employesIds)
            ->where('statut', 'pending')
            ->findOrFail($id);

        $deplacement->update([
            'statut' => 'approved',
            'valide_par' => $manager->id,
            'date_validation' => now(),
        ]);

        return redirect()->route('manager.deplacement.index')
            ->with('success', 'Déplacement accepté.');
    }

    /**
     * Refuser un déplacement
     */
    public function refuser(Request $request, $id)
    {
        $request->validate([
            'motif_refus' => 'required|string|min:3|max:500',
        ]);

        $manager = Auth::user();
        $employesIds = $manager->employes()->pluck('id');

        $deplacement = Deplacement::whereIn('user_id', $employesIds)
            ->where('statut', 'pending')
            ->findOrFail($id);

        $deplacement->update([
            'statut' => 'refused',
            'valide_par' => $manager->id,
            'commentaire_manager' => $request->motif_refus,
            'date_validation' => now(),
        ]);

        return redirect()->route('manager.deplacement.index')
            ->with('error', 'Déplacement refusé.');
    }
}

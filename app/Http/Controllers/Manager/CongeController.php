<?php
namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Conge;
use App\Models\Remplacement;
use App\Models\User;
use App\Notifications\CongeAccepteNotification;
use App\Notifications\CongeRefuseNotification;
use App\Notifications\PropositionRemplacementNotification;
use App\Services\MatchingService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CongeController extends Controller
{
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

        if (! $demande) {
            return redirect()->back()->with('error', 'Demande introuvable.');
        }

        // Calculer la durée
        $debut = Carbon::parse($demande->date_debut);
        $fin   = Carbon::parse($demande->date_fin);
        $duree = $debut->diffInDays($fin) + 1;

        // Déduire les congés restants
        if ($demande->type == 'paye') {
            $employe = $demande->user;
            $employe->decrement('conges_restants', $duree);
        }

        // Mettre à jour la demande
        $demande->update([
            'statut'          => 'approved',
            'valide_par'      => $manager->id,
            'date_validation' => now(),
        ]);

        $demande->user->notify(new CongeAccepteNotification($demande));

        return redirect()->route('manager.conges.propositions', $demande->id)
            ->with('success', 'Congé accepté. Voici les remplaçants potentiels.');
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

        $demande->user->notify(new CongeRefuseNotification($demande));
        return redirect()->route('manager.conges.index')
            ->with('success', 'Congé refusé. Motif enregistré.');
    }

    public function propositions($id)
    {
        $manager     = Auth::user();
        $employesIds = $manager->employes()->pluck('id');

        $conge = Conge::whereIn('user_id', $employesIds)->findOrFail($id);

        // Calculer les propositions
        $matchingService = app(MatchingService::class);
        $propositions    = $matchingService->trouverRemplacants($conge);

        return view('manager.conge.propositions', compact('conge', 'propositions'));
    }

    public function proposer(Request $request, $id)
    {
        $manager     = Auth::user();
        $employesIds = $manager->employes()->pluck('id');

        $conge      = Conge::whereIn('user_id', $employesIds)->findOrFail($id);
        $remplacant = User::findOrFail($request->remplacant_id);

        $matchingService = app(MatchingService::class);
        $remplacement    = $matchingService->proposerRemplacant($conge, $remplacant, $manager);

        $remplacant->notify(new PropositionRemplacementNotification($remplacement));

        return redirect()->route('manager.conges.index')
            ->with('success', 'Proposition envoyée à ' . $remplacant->name);
    }

// Accepter le remplacement (pour le remplaçant)
    public function accepterRemplacement($id)
    {
        $remplacement = Remplacement::findOrFail($id);

        if ($remplacement->remplacant_id != Auth::id()) {
            abort(403);
        }

        $matchingService = app(MatchingService::class);
        $matchingService->accepterRemplacement($remplacement);

        return redirect()->route('employe.dashboard')
            ->with('success', 'Vous avez accepté le remplacement. Les tâches ont été transférées.');
    }

// Refuser le remplacement
    public function refuserRemplacement($id)
    {
        $remplacement = Remplacement::findOrFail($id);

        if ($remplacement->remplacant_id != Auth::id()) {
            abort(403);
        }

        $remplacement->refuser();

        return redirect()->route('employe.dashboard')
            ->with('info', 'Vous avez refusé le remplacement.');
    }
}

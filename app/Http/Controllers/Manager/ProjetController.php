<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Projet;
use App\Models\Tache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjetController extends Controller
{
    /**
     * Liste des projets du manager
     */
    public function index()
    {
        $manager = Auth::user();

        $projets = Projet::where('chef_projet_id', $manager->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('manager.projet.index', compact('projets'));
    }

    /**
     * Formulaire de création
     */
    public function create()
    {
        $manager = Auth::user();
        $employes = $manager->employes;

        return view('manager.projet.create', compact('employes'));
    }

    /**
     * Enregistrer un projet
     */
    public function store(Request $request)
    {
        $manager = Auth::user();

        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'budget_previsionnel' => 'nullable|numeric|min:0',
            'employes' => 'array',
        ]);

        $projet = Projet::create([
            'nom' => $request->nom,
            'description' => $request->description,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'budget_previsionnel' => $request->budget_previsionnel ?? 0,
            'budget_reel' => 0,
            'avancement' => 0,
            'statut' => 'en_attente',
            'chef_projet_id' => $manager->id,
        ]);

        if ($request->has('employes')) {
            foreach ($request->employes as $employeId) {
                $projet->employes()->attach($employeId, [
                    'role_dans_projet' => 'Membre',
                    'heures_prevues' => 0,
                    'heures_reelles' => 0,
                ]);
            }
        }

        return redirect()->route('manager.projet.index')
            ->with('success', 'Projet créé avec succès');
    }

    /**
     * Afficher un projet
     */
    public function show($id)
    {
        $manager = Auth::user();
        $projet = Projet::where('chef_projet_id', $manager->id)
            ->findOrFail($id);

        $taches = Tache::where('projet_id', $projet->id)->get();

        $projet->calculerAvancement();

        return view('manager.projet.show', compact('projet', 'taches'));
    }

    /**
     * Formulaire d'édition
     */
    public function edit($id)
    {
        $manager = Auth::user();
        $projet = Projet::where('chef_projet_id', $manager->id)
            ->findOrFail($id);
        $employes = $manager->employes;
        $employesIds = $projet->employes->pluck('id')->toArray();

        return view('manager.projet.edit', compact('projet', 'employes', 'employesIds'));
    }

    /**
     * Mettre à jour un projet
     */
    public function update(Request $request, $id)
    {
        $manager = Auth::user();
        $projet = Projet::where('chef_projet_id', $manager->id)
            ->findOrFail($id);

        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'budget_previsionnel' => 'nullable|numeric|min:0',
            'budget_reel' => 'nullable|numeric|min:0',
            'statut' => 'required|in:en_attente,en_cours,termine,annule',
            'employes' => 'array',
        ]);

        $projet->update([
            'nom' => $request->nom,
            'description' => $request->description,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'budget_previsionnel' => $request->budget_previsionnel ?? 0,
            'budget_reel' => $request->budget_reel ?? 0,
            'statut' => $request->statut,
        ]);

        $projet->employes()->sync($request->employes ?? []);

        return redirect()->route('manager.projet.index')
            ->with('success', 'Projet modifié avec succès');
    }

    /**
     * Supprimer un projet
     */
    public function destroy($id)
    {
        $manager = Auth::user();
        $projet = Projet::where('chef_projet_id', $manager->id)
            ->findOrFail($id);

        $projet->delete();

        return redirect()->route('manager.projet.index')
            ->with('success', 'Projet supprimé');
    }

    /**
     * Ajouter une tâche au projet
     */
    public function addTache(Request $request, $id)
    {
        $manager = Auth::user();
        $projet = Projet::where('chef_projet_id', $manager->id)
            ->findOrFail($id);

        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assignee_a' => 'required|exists:users,id',
            'duree_estimee' => 'required|integer|min:1',
            'deadline' => 'required|date',
        ]);

        $tache = Tache::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'assignee_a' => $request->assignee_a,
            'cree_par' => $manager->id,
            'projet_id' => $projet->id,
            'duree_estimee' => $request->duree_estimee,
            'deadline' => $request->deadline,
            'statut' => 'todo',
        ]);

        $projet->calculerAvancement();

        return redirect()->route('manager.projet.show', $projet->id)
            ->with('success', 'Tâche ajoutée au projet');
    }
}

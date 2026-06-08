<?php
namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Projet;
use App\Models\Tache;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TacheController extends Controller
{
    /**
     * Liste des tâches de l'équipe
     */
    public function index()
    {
        $manager     = Auth::user();
        $employesIds = $manager->employes()->pluck('id');

        $taches = Tache::whereIn('assignee_a', $employesIds)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('manager.tache.index', compact('taches'));
    }

    /**
     * Formulaire de création
     */
    public function create()
    {
        $manager  = Auth::user();
        $employes = $manager->employes;
        $projets  = Projet::where('chef_projet_id', $manager->id)
            ->orWhereIn('id', function ($query) use ($manager) {
                $query->select('projet_id')
                    ->from('employe_projet')
                    ->whereIn('employe_id', $manager->employes()->pluck('id'));
            })
            ->get();

        return view('manager.tache.create', compact('employes', 'projets'));
    }

    /**
     * Enregistrer une tâche
     */
    public function store(Request $request)
    {
        $manager = Auth::user();

        $request->validate([
            'titre'         => 'required|string|max:255',
            'description'   => 'nullable|string',
            'assignee_a'    => 'required|exists:users,id',
            'projet_id'     => 'nullable|exists:projets,id',
            'duree_estimee' => 'required|integer|min:1',
            'deadline'      => 'required|date|after_or_equal:today',
        ]);

        // Vérifier que l'employé appartient bien au manager
        $employesIds = $manager->employes()->pluck('id');
        if (! in_array($request->assignee_a, $employesIds->toArray())) {
            return back()->with('error', 'Employé non autorisé');
        }

        $tache = Tache::create([
            'titre'         => $request->titre,
            'description'   => $request->description,
            'assignee_a'    => $request->assignee_a,
            'cree_par'      => $manager->id,
            'projet_id'     => $request->projet_id,
            'duree_estimee' => $request->duree_estimee,
            'deadline'      => $request->deadline,
            'statut'        => 'todo',
        ]);

        // Recalculer la charge de l'employé
        $this->recalculerCharge($request->assignee_a);

        return redirect()->route('manager.tache.index')
            ->with('success', 'Tâche créée avec succès');
    }

    /**
     * Afficher le détail d'une tâche
     */
    public function show($id)
    {
        $manager     = Auth::user();
        $employesIds = $manager->employes()->pluck('id');

        $tache = Tache::whereIn('assignee_a', $employesIds)->findOrFail($id);

        return view('manager.tache.show', compact('tache'));
    }

    /**
     * Formulaire d'édition
     */
    public function edit($id)
    {
        $manager     = Auth::user();
        $employesIds = $manager->employes()->pluck('id');

        $tache    = Tache::whereIn('assignee_a', $employesIds)->findOrFail($id);
        $employes = $manager->employes;
        $projets  = Projet::where('chef_projet_id', $manager->id)->get();

        return view('manager.tache.edit', compact('tache', 'employes', 'projets'));
    }

    /**
     * Mettre à jour une tâche
     */
    public function update(Request $request, $id)
    {
        $manager     = Auth::user();
        $employesIds = $manager->employes()->pluck('id');

        $tache = Tache::whereIn('assignee_a', $employesIds)->findOrFail($id);

        $request->validate([
            'titre'         => 'required|string|max:255',
            'description'   => 'nullable|string',
            'assignee_a'    => 'required|exists:users,id',
            'projet_id'     => 'nullable|exists:projets,id',
            'duree_estimee' => 'required|integer|min:1',
            'deadline'      => 'required|date',
            'statut'        => 'required|in:todo,doing,done',
        ]);

        $ancienAssign = $tache->assignee_a;

        $tache->update([
            'titre'         => $request->titre,
            'description'   => $request->description,
            'assignee_a'    => $request->assignee_a,
            'projet_id'     => $request->projet_id,
            'duree_estimee' => $request->duree_estimee,
            'deadline'      => $request->deadline,
            'statut'        => $request->statut,
            'date_fin'      => $request->statut == 'done' ? now() : null,
        ]);

        // Recalculer les charges
        $this->recalculerCharge($ancienAssign);
        if ($ancienAssign != $request->assignee_a) {
            $this->recalculerCharge($request->assignee_a);
        }

        return redirect()->route('manager.tache.index')
            ->with('success', 'Tâche modifiée avec succès');
    }

    /**
     * Supprimer une tâche
     */
    public function destroy($id)
    {
        $manager     = Auth::user();
        $employesIds = $manager->employes()->pluck('id');

        $tache     = Tache::whereIn('assignee_a', $employesIds)->findOrFail($id);
        $employeId = $tache->assignee_a;

        $tache->delete();

        $this->recalculerCharge($employeId);

        return redirect()->route('manager.tache.index')
            ->with('success', 'Tâche supprimée avec succès');
    }

    /**
     * Recalculer la charge d'un employé
     */
    private function recalculerCharge($employeId)
    {
        $employe = User::find($employeId);
        if ($employe) {
            $tachesEnCours = Tache::where('assignee_a', $employeId)
                ->where('statut', '!=', 'done')
                ->sum('duree_estimee');

            $charge                   = min(150, ($tachesEnCours / 40) * 100);
            $employe->charge_actuelle = round($charge, 2);
            $employe->save();
        }
    }
}
<?php
namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompetenceController extends Controller
{
    /**
     * Liste des employés avec leurs compétences
     */
    public function index()
    {
        $manager  = Auth::user();
        $employes = $manager->employes()->with('competences')->get();

        return view('manager.competences.index', compact('employes'));
    }

    /**
     * Afficher les compétences d'un employé
     */
    public function show($id)
    {
        $manager     = Auth::user();
        $employe     = User::where('manager_id', $manager->id)->findOrFail($id);
        $competences = $employe->competences;

        return view('manager.competences.show', compact('employe', 'competences'));
    }

    /**
     * Valider une compétence
     */
    public function valider(Request $request, $employeId, $competenceId)
    {
        $manager = Auth::user();
        $employe = User::where('manager_id', $manager->id)->findOrFail($employeId);

        $employe->competences()->updateExistingPivot($competenceId, [
            'validee'     => true,
            'validee_par' => $manager->id,
        ]);

        return redirect()->back()->with('success', 'Compétence validée');
    }

    /**
     * Refuser une compétence
     */
    public function refuser(Request $request, $employeId, $competenceId)
    {
        $manager = Auth::user();
        $employe = User::where('manager_id', $manager->id)->findOrFail($employeId);

        $employe->competences()->updateExistingPivot($competenceId, [
            'niveau'      => $request->niveau,
            'validee'     => true,
            'validee_par' => $manager->id,
        ]);

        return redirect()->back()->with('success', 'Niveau modifié et validé');
    }
}
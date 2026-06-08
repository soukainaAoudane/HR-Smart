<?php
namespace App\Http\Controllers\Employe;

use App\Http\Controllers\Controller;
use App\Models\Tache;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Services\PerformanceService;


class EmployeDashboardController extends Controller
{
    public function index(PerformanceService $performanceService)
    {
        $employe = Auth::user();
        $manager = User::find($employe->manager_id);

        $congesRestants     = $employe->conges_restants;
        $cinqDerniersConges = $employe->conges()->orderBy('created_at', 'desc')->take(5)->get();
        $taches             = Tache::where('assignee_a', $employe->id)->where('statut', '!=', 'done')->get();

        $tachesEnCours = Tache::where('assignee_a', $employe->id)->where('statut', 'doing')->get();

        $mesCompetences = $employe->competences;

        $mesDeplacements = $employe->deplacements()->orderBy('created_at', 'desc')->get();

        $performanceActuelle = $performanceService->getPerformanceActuelle($employe);
        $evolution = $performanceService->getEvolution($employe, 6);

        return view('employe.dashboard', compact('employe', 'manager', 'congesRestants', 'taches', 'tachesEnCours', 'mesCompetences', 'mesDeplacements', 'cinqDerniersConges', 'performanceActuelle', 'evolution'));
    }
}

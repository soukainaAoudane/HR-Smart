<?php
namespace App\Http\Controllers\Employe;

use App\Http\Controllers\Controller;
use App\Models\Tache;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EmployeDashboardController extends Controller
{
    public function index()
    {
        $employe = Auth::user();

        $nom     = $employe->name;
        $email   = $employe->email;
        $poste   = $employe->poste;
        $manager = User::find($employe->manager_id);

        $congesRestants = $employe->conges_restants;

        $charge_actuelle = $employe->charge_actuelle;

        $taches        = Tache::where('assignee_a', $employe->id)->where('statut', '!=', 'done')->get();
        $tachesEnCours = Tache::where('assignee_a', $employe->id)->where('statut', 'doing')->get();
        return view('employe.dashboard', compact('employe', 'nom', 'email', 'poste', 'manager', 'congesRestants', 'charge_actuelle', 'taches', 'tachesEnCours'));
    }
}

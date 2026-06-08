<?php
    namespace App\Http\Controllers\AdminRH;

    use App\Http\Controllers\Controller;
    use App\Models\User;
    use App\Models\Conge;
    use App\Models\Competence;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

     class DashboardController extends Controller
    {
        // Methode index:
        public function index()
        {
            $user = Auth::user();
            if(!$user->isAdmin()){
                abort(403, 'Accées refusé');
            }

            $totalEmployes = User::where('role', 'employe')->count();
            $totalManagers = User::where('role', 'manager')->count();
            $totalAdmins = User::where('role', 'admin')->count();
            $totalCompetences = Competence::count();

            $congesEnAttente = Conge::where('statut', 'pending')->count();
            $congesApprouves = Conge::where('statut', 'approved')->count();
            $congesRefuses = Conge::where('statut', 'refused')->count();

            $chargeMoyenne = User::where('role', 'employe')->avg('charge_actuelle')?? 0;

            $derniersEmployes = User::where('role', 'employe')->orderBy('created_at', 'desc')->limit(5)->get();

            $derniersDemandes = Conge::with('user')->orderBy('created_at', 'desc')->limit(5)->get();


            return view('admin.dashboard', compact('totalEmployes', 'totalManagers', 'totalAdmins', 'totalCompetences', 'congesEnAttente', 'congesApprouves', 'congesRefuses', 'chargeMoyenne', 'derniersEmployes', 'derniersDemandes'));
        }
    }
?>
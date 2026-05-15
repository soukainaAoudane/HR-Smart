<?php
namespace App\Http\Controllers\Employe;

use App\Http\Controllers\Controller;
use App\Models\Tache;
use Illuminate\Support\Facades\Auth;

class ManagerDashboardController extends Controller
{

    public function index(){
        $manager = Auth::user();
        return view('manager.dashboard','manager');
    }
}

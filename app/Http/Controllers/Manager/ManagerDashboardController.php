<?php
namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Tache;
use Illuminate\Support\Facades\Auth;

class ManagerDashboardController extends Controller
{

    public function index(){
        $manager = Auth::user();
        $employes = $manager->employes;
        return view('manager.dashboard',compact('manager', 'employes'));
    }
}

<?php
namespace App\Http\Controllers\AdminRH;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    //

    public function index()
    {
        $employes = User::where('role', 'employe')->get();
        $managers = User::where('role', 'manager')->get();

        return view('admin.employes.index', compact('employes', 'managers'));

    }

    public function updateManager(Request $request, $id){
        $employe = User::findOrFail($id);
        $employe->manager_id = $request->manager_id;
        $employe->save();

        return redirect()->back()->with('success', 'Manager assigné avec success');
    }
}

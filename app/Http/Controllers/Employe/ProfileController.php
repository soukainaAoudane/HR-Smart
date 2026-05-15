<?php
namespace App\Http\Controllers\Employe;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user    = Auth::user();
        $manager=null;
        if ($user->manager_id && $user->manager_id != $user->id) {
    $manager = User::find($user->manager_id);
}

        return view('employe.profil', compact('user', 'manager'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'poste' => 'nullable|string|max:255',
        ]);

        $user->update($data);

        return redirect()->back()->with('success', 'profile modififer');

    }
}
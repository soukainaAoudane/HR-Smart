<?php
namespace App\Http\Controllers\Employe;

use App\Http\Controllers\Controller;
use App\Models\Tache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TacheController extends Controller
{
    public function index()
    {
        $user   = Auth::user();
        $taches = Tache::where('assignee_a', $user->id)
            ->orderBy('deadline', 'asc')
            ->get();

        return view('employe.tache.index', compact('taches'));
    }

    public function update(Request $request, $id)
    {
        $user  = Auth::user();
        $tache = Tache::where('assignee_a', $user->id)->findOrFail($id);

        $request->validate([
            'statut' => 'required|in:todo,doing,done',
        ]);

        $tache->update([
            'statut'   => $request->statut,
            'date_fin' => $request->statut == 'done' ? now() : null,
        ]);

        return redirect()->route('employe.tache.index')
            ->with('success', 'Statut mis à jour');
    }
}
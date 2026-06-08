<?php
namespace App\Http\Controllers\Employe;

use App\Http\Controllers\Controller;
use App\Models\Conge;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CongeController extends Controller
{
    // Methode index:
    public function index()
    {
        $user = Auth::user();

        if ($user->isManager()) {
            $employeIds = $user->employes()->pluck('id');
            $conges     = Conge::whereIn('user_id', $employeIds)->orderBy('created_at', 'desc')->get();
        } else {
            $conges = $user->conges()->orderBy('created_at', 'desc')->get();
        }

        return view('employe.conge.index', compact('conges'));
    }

    // Methode create
    public function create()
    {
        $user           = Auth::user();
        $congesRestants = $user->conges_restants;

        return view('employe.conge.create', compact('congesRestants'));
    }

    // Methode store
    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'type'         => 'required|in:paye,rtt,sans_solde,formation',
            'date_debut'   => 'required|after_or_equal:today',
            'date_fin'     => 'required|after_or_equal:date_debut',
            'motif'        => 'required|string|max:500',
            'justificatif' => 'required_if:type,formation|file|mimes:pdf,doc,docx|max:2028',
        ]);

        $duree = Carbon::parse($request->date_debut)->diffInDays(Carbon::parse($request->date_fin)) + 1;

        if ($request->type == 'paye' && $duree > $user->conges_restants) {
            return back()->with('error', 'Solde de congés payés insuffisants');
        }

        if ($request->type == 'sans_solde' && $user->conges_restants > 0) {
            return back()->with('error', 'Vous avez des congés payés, vous pouvez les utiliser');
        }

        $justificatifPath = null;
        if ($request->hasFile('justificatif')) {
            $justificatifPath = $request->file('justificatif')->store('justificatifs', 'public');
        }

        $conge = Conge::create([
            'user_id'      => $user->id,
            'date_debut'   => $request->date_debut,
            'date_fin'     => $request->date_fin,
            'type'         => $request->type,
            'statut'       => 'pending',
            'motif'        => $request->motif,
            'justificatif' => $justificatifPath,
            'duree'        => $duree,
        ]);

        return redirect()->route('employe.conge.index')->with('success', 'Demande de congé envoyée');
    }

    // Methode show
    public function show($id)
    {
        $user = Auth::user();

        $conge = Conge::where('id', $id)->where('user_id', $user->id)->firstOrFail();

        return view('employe.conge.show', compact('conge'));
    }

    // Methode annuler
    public function annuler($id)
    {
        $user = Auth::user();

        if (! $user->isEmploye()) {
            abort(403, "Non autorisé");
        }

        $conge = Conge::where('user_id', $user->id)->where('id', $id)->firstOrFail();
        if ($conge->statut != 'pending') {
            return back()->with('error', 'Seules les demandes en attente peuvent être annulées');
        }

        $conge->delete();

        return redirect()->route('employe.conge.index')->with('success', 'Demande annulée');
    }
}
<?php
namespace App\Http\Controllers\Employe;

use App\Http\Controllers\Controller;
use App\Models\Deplacement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeplacementController extends Controller
{
    //
    public function index()
    {
        $user         = Auth::user();
        $deplacements = $user->deplacements()->orderBy('created_at', 'desc')->get();
        return view('employe.deplacement.index', compact('deplacements'));
    }

    public function create()
    {
        return view('employe.deplacement.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'date_debut'        => 'required|date|after_or_equal:today',
            'date_fin'          => 'required|date|after_or_equal:date_debut',
            'lieu'              => 'required|string|max:255',
            'client'            => 'nullable|string|max:255',
            'motif'             => 'nullable|string|max:255',
            'frais_transport'   => 'nullable|numeric|min:0',
            'frais_hebergement' => 'nullable|numeric|min:0',
            'frais_repas'       => 'nullable|numeric|min:0',
            'justificatif'      => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $justificatifPath = null;
        if ($request->hasFile('justificatif')) {
            $justificatifPath = $request->file('justificatif')->store('justificatifs', 'public');
        }

        $fraisTotal = ($request->frais_transport ?? 0) + ($request->frais_hebergement ?? 0) + ($request->frais_repas ?? 0);

        $deplacement = Deplacement::create([
            'user_id'           => $user->id,
            'date_debut'        => $request->date_debut,
            'date_fin'          => $request->date_fin,
            'lieu'              => $request->lieu,
            'client'            => $request->client,
            'motif'             => $request->motif,
            'frais_transport'   => $request->frais_transport ?? 0,
            'frais_hebergement' => $request->frais_hebergement ?? 0,
            'frais_repas'       => $request->frais_repas ?? 0,
            'frais_total'       => $fraisTotal,
            'statut'            => 'pending',
            'justificatif'      => $justificatifPath,
        ]);

        return redirect()->route('employe.deplacement.index')->with('success', 'Demandee de déplacement evnoyé avec success');

    }

    public function show($id)
    {
        $user        = Auth::user();
        $deplacement = Deplacement::where('user_id', $user->id)->findOrFail($id);

        return view('employe.deplacement.show', compact('deplacement'));
    }

    public function destroy($id)
    {
        $user        = Auth::user();
        $deplacement = Deplacement::where('user_id', $user->id)->findOrFail($id);
        $deplacement->delete();
        return redirect()->route('employe.deplacement.index')->with('success', 'Demande de déplacement supprimée avec succès');
    }

}
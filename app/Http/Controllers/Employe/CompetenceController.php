<?php
namespace App\Http\Controllers\Employe;

use App\Http\Controllers\Controller;
use App\Models\Competence;
use App\Models\UserCompetence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompetenceController extends Controller
{
    /**
     * Afficher le formulaire d'auto-évaluation
     */
    public function index()
    {
        $user = Auth::user();

        // Récupérer toutes les compétences
        $competences = Competence::orderBy('categorie')->orderBy('nom')->get();

        // Récupérer les niveaux actuels de l'utilisateur
        $mesCompetences = [];
        foreach ($user->competences as $comp) {
            $mesCompetences[$comp->id] = $comp->pivot->niveau;
        }

        return view('employe.competences', compact('competences', 'mesCompetences'));
    }

    /**
     * Enregistrer l'auto-évaluation
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'competences'   => 'array',
            'competences.*' => 'integer|between:1,5',
        ]);

        // Supprimer les anciennes évaluations non validées
        UserCompetence::where('user_id', $user->id)
            ->where('validee', false)
            ->delete();

        // Enregistrer les nouvelles évaluations
        if ($request->has('competences')) {
            foreach ($request->competences as $competenceId => $niveau) {
                if ($niveau >= 1 && $niveau <= 5) {
                    UserCompetence::updateOrCreate(
                        [
                            'user_id'       => $user->id,
                            'competence_id' => $competenceId,
                        ],
                        [
                            'niveau'        => $niveau,
                            'validee'       => false,
                            'auto_detectee' => false,
                        ]
                    );
                }
            }
        }

        return redirect()->route('employe.competences')
            ->with('success', 'Auto-évaluation enregistrée. En attente de validation par votre manager.');
    }
}

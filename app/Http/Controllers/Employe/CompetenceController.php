<?php
namespace App\Http\Controllers\Employe;

use App\Http\Controllers\Controller;
use App\Models\Competence;
use App\Models\UserCompetence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompetenceController extends Controller
{

    // Methode index:
    public function index(){
        $user = Auth::user();

        $competences = Competence::orderBy('categorie')->orderBy('nom')->get();

        $mesNiveaux = $user->competences->pluck('pivot.niveau','id');

        $mesCompetences = $user->competences;

        return view('employe.competences',compact('mesCompetences','mesNiveaux','competences'));
    }

    // Methode update
    public function update(Request $request){
        $user = Auth::user();

        $request->validate([
            'competences'=>'array',
            'competences.*'=>'integer|between:1,5',
        ]);

        UserCompetence::where('user_id',$user->id)->where('validee',false)->delete();

        foreach($request->competences as $competenceId=>$niveau){
            if($niveau<6 && $niveau>0){
                UserCompetence::updateOrCreate([
                    'user_id'=>$user->id,
                    'competence_id'=>$competenceId,
                ],
                [
                    'niveau'=>$niveau,
                    'validee'=>false,
                    'auto_detectee'=>false,
                ]
                );
            }
        }

        return redirect()->route('employe.competences')->with("success","la modification a ete savée dnas l'attente de la validation de votre manageer");
    }

}
<?php
namespace App\Services;

use App\Models\Performance;
use App\Models\Tache;
use App\Models\User;
use Carbon\Carbon;

class PerformanceService
{
    public function calculerPerformance(User $user, $mois = null, $annee = null)
    {
        if (! $mois) {
            $mois = Carbon::now->month;
        }

        if (! $annee) {
            $annee = Carbon::now->year;
        }

        $taches = Tache::where('assignee_a', $user->id)
            ->whereYear('created_at', $annee)
            ->whereMonth('created_at', $mois)
            ->get();

        $totalTaches     = $taches->count();
        $tachesTerminees = $taches->where('statut', 'done')->count();

        if ($totalTaches == 0) {
            $tauxCompletion = 100;
        } else {
            $tauxCompletion = ($tachesTerminees / $totalTaches) * 100;
        }

        $tachesDansLesTemps = $taches->filter(function ($tache) {
            return $tache->statut == 'done' &&
            $tache->date_fin &&
            $tache->date_fin <= $tache->deadline;
        })->count();

        if ($tachesTerminees == 0) {
            $respectDelais = 100;
        } else {
            $respectDelais = ($tachesDansLesTemps / $tachesTerminees) * 100;
        }

        $scoreGlobal = ($tauxCompletion * 0.6) + ($respectDelais * 0.4);

        $performance = Performance::updateOrCreate(
            [
                'user_id' => $user->id,
                'mois'    => $mois,
                'annee'   => $annee,
            ],
            [
                'taux_completion' => $tauxCompletion,
                'respect_delais'  => $respectDelais,
                'score_global'    => $scoreGlobal,
            ]
        );

        return $performance;
    }

    public function calculerToutesPerformances($mois = null, $annee = null)
    {
        if (! $mois) {
            $mois = Carbon::now->month;
        }

        if (! $annee) {
            $annee = Carbon::now->year;
        }

        $employes = User::where('role', 'employe')->get();

        foreach ($employes as $employe) {
            $this->calculerPerformance($employe, $mois, $annee);
        }
    }

    public function getPerformanceActuelle(User $user)
    {
        $dernier = Performance::where('user_id', $user->id)
            ->orderBy('annee', 'desc')
            ->orderBy('mois', 'desc')
            ->first();

        return $dernier ? $dernier->score_global : 0;
    }

    public function getEvolution(User $user, $nbMois = 6)
    {
        $performance = Performance::where('user_id', $user->id)
            ->orderBy('annee', 'desc')
            ->orderBy('mois', 'desc')
            ->limit($nbMois)
            ->get()
            ->reverse()
            ->values();

        $labels = [];
        $scores = [];

        foreach ($performance as $perf) {
            $labels[] = $this->getNomMois($perf->mois) . '' . $perf->annee;
            $scores[] = $perf->score_global;
        }

        return [
            'labels' => $labels,
            'scores' => $scores,
        ];
    }

    public function getNomMois($mois){
        $moisNoms = [
            1 => 'Jan', 2=>'Fev', 3=>'Mar', 4=>'Avr', 5=>'Mai', 6=>'Juin', 7=>'Juil', 8=>'Aou',9=>'Sep', 10=>'Oct', 11=>'Nov', 12=>'Dec',
        ];
        return $moisNoms[$mois] ?? $mois;
    }

    
}
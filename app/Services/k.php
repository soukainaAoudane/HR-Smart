<?php
namespace App\Services;

use App\Models\Conge;
use App\Models\Remplacement;
use App\Models\Tache;
use App\Models\User;

class MatchingService
{
    protected $performanceService;

    public function __construct(PerformanceService $performanceService)
    {
        $this->performanceService = $performanceService;
    }

    /**
     * Trouver les meilleurs remplaçants pour un congé
     */
    public function trouverRemplacants(Conge $conge, $limit = 5)
    {
        $manager = $conge->user->manager;

        if (! $manager) {
            return collect([]);
        }

        // 1. Récupérer les employés de la même équipe
        $employes = $manager->employes()
            ->where('id', '!=', $conge->user_id)
            ->get();

        // 2. Compétences requises pour le poste
        $poste               = $conge->user->poste;
        $competencesRequises = $this->getCompetencesForPoste($poste);

        $resultats = [];

        foreach ($employes as $employe) {
            $score = $this->calculerScore($employe, $conge, $competencesRequises);

            if ($score >= 60) {
                $resultats[] = [
                    'employe' => $employe,
                    'score'   => $score,
                    'details' => $this->getDetailsScore($employe, $conge),
                ];
            }
        }

        // Trier par score décroissant
        usort($resultats, function ($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        return collect($resultats)->take($limit);
    }

    /**
     * Calculer le score pour un employé
     */
    private function calculerScore(User $employe, Conge $conge, $competencesRequises)
    {
        // 1. Score Compétences (40%)
        $scoreCompetences = $this->calculerScoreCompetences($employe, $competencesRequises);

        // 2. Score Disponibilité (30%)
        $scoreDisponibilite = $this->calculerScoreDisponibilite($employe, $conge);

        // 3. Score Charge (20%)
        $scoreCharge = $this->calculerScoreCharge($employe);

        // 4. Score Performance (10%)
        $scorePerformance = $this->calculerScorePerformance($employe);

        // Score total
        $scoreTotal = ($scoreCompetences * 0.4)
             + ($scoreDisponibilite * 0.3)
             + ($scoreCharge * 0.2)
             + ($scorePerformance * 0.1);

        return round($scoreTotal, 2);
    }

    /**
     * Score compétences
     */
    private function calculerScoreCompetences(User $employe, $competencesRequises)
    {
        if (empty($competencesRequises)) {
            return 100;
        }

        $employeCompetences = $employe->competencesValidees()
            ->pluck('pivot.niveau', 'nom')
            ->toArray();

        $total = 0;
        $count = 0;

        foreach ($competencesRequises as $competence => $niveauRequis) {
            $niveauEmploye  = $employeCompetences[$competence] ?? 0;
            $ratio          = min(1, $niveauEmploye / max($niveauRequis, 1));
            $total         += $ratio * 100;
            $count++;
        }

        return $count > 0 ? round($total / $count, 2) : 100;
    }

    /**
     * Score disponibilité (pas de congé sur la période)
     */
    private function calculerScoreDisponibilite(User $employe, Conge $conge)
    {
        $conges = Conge::where('user_id', $employe->id)
            ->where('statut', 'approved')
            ->where(function ($query) use ($conge) {
                $query->whereBetween('date_debut', [$conge->date_debut, $conge->date_fin])
                    ->orWhereBetween('date_fin', [$conge->date_debut, $conge->date_fin]);
            })
            ->count();

        return $conges > 0 ? 0 : 100;
    }

    /**
     * Score charge actuelle
     */
    private function calculerScoreCharge(User $employe)
    {
        $charge = $employe->charge_actuelle;

        if ($charge <= 80) {
            return 100;
        } elseif ($charge <= 100) {
            return 80;
        } elseif ($charge <= 120) {
            return 50;
        } else {
            return max(0, 100 - ($charge - 120));
        }
    }

    /**
     * Score performance
     */
    private function calculerScorePerformance(User $employe)
    {
        $performance = $this->performanceService->getPerformanceActuelle($employe);
        return $performance;
    }

    /**
     * Compétences requises pour un poste (exemple)
     */
    private function getCompetencesForPoste($poste)
    {
        // À personnaliser selon vos besoins
        $competencesParPoste = [
            'Développeur Laravel'  => ['Laravel' => 4, 'PHP' => 4, 'MySQL' => 3, 'Git' => 3],
            'Développeur Frontend' => ['React' => 4, 'JavaScript' => 4, 'CSS' => 3],
            'Chef de projet'       => ['Gestion de projet' => 4, 'Communication' => 4, 'Agile' => 3],
        ];

        return $competencesParPoste[$poste] ?? ['Général' => 3];
    }

    /**
     * Détails du score
     */
    private function getDetailsScore(User $employe, Conge $conge)
    {
        return [
            'competences'   => round($this->calculerScoreCompetences($employe, $this->getCompetencesForPoste($conge->user->poste)), 2),
            'disponibilite' => $this->calculerScoreDisponibilite($employe, $conge),
            'charge'        => $this->calculerScoreCharge($employe),
            'performance'   => $this->calculerScorePerformance($employe),
        ];
    }

    /**
     * Proposer un remplaçant
     */
    public function proposerRemplacant(Conge $conge, User $remplacant, User $manager)
    {
        // Calculer le score
        $competencesRequises = $this->getCompetencesForPoste($conge->user->poste);
        $score               = $this->calculerScore($remplacant, $conge, $competencesRequises);

        // Créer la proposition
        $remplacement = Remplacement::create([
            'conge_id'       => $conge->id,
            'remplacant_id'  => $remplacant->id,
            'score_matching' => $score,
            'statut'         => 'proposed',
            'propose_par'    => $manager->id,
        ]);

        return $remplacement;
    }

    /**
     * Accepter le remplacement
     */
    public function accepterRemplacement(Remplacement $remplacement)
    {
        $remplacement->accepter();

        // Transférer les tâches
        $this->transfererTaches($remplacement->conge->user, $remplacement->remplacant);

        return $remplacement;
    }

    /**
     * Transférer les tâches de l'absent vers le remplaçant
     */
    private function transfererTaches(User $absent, User $remplacant)
    {
        $taches = Tache::where('assignee_a', $absent->id)
            ->where('statut', '!=', 'done')
            ->get();

        foreach ($taches as $tache) {
            $tache->update([
                'assignee_a' => $remplacant->id,
            ]);
        }

        // Recalculer les charges
        $this->recalculerCharge($absent);
        $this->recalculerCharge($remplacant);
    }

    private function recalculerCharge(User $user)
    {
        $tachesEnCours = Tache::where('assignee_a', $user->id)
            ->where('statut', '!=', 'done')
            ->sum('duree_estimee');

        $charge                = min(150, ($tachesEnCours / 40) * 100);
        $user->charge_actuelle = round($charge, 2);
        $user->save();
    }
}

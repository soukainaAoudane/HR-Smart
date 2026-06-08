<?php

namespace App\Console\Commands;

use App\Services\PerformanceService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CalculerPeroformances extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'performances:calculer {--mois=}{--annee=}
';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculer les performances des employes';

    /**
     * Execute the console command.
     */
    public function handle(PerformanceService $performanceService)
    {
        //
        $mois = $this->option('mois') ?? Carbon::now()->subMonth()->month;
        $annee = $this->option('annee') ?? Carbon::now()->subYear()->year;

        $this->info("Calcul des performances pour {$mois} /{$annee} ");

        $performanceService->calculerToutesPerformances($mois, $annee);

        $this->info("Calcule terminnee");
        return Command::SUCCESS;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
        'date_debut',
        'date_fin',
        'budget_previsionnel',
        'budget_reel',
        'avancement',
        'statut',
        'chef_projet_id',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
    ];

    const STATUT_EN_ATTENTE = 'en_attente';
    const STATUT_EN_COURS = 'en_cours';
    const STATUT_TERMINE = 'termine';
    const STATUT_ANNULE = 'annule';

    public function chefProjet()
    {
        return $this->belongsTo(User::class, 'chef_projet_id');
    }

    public function employes()
    {
        return $this->belongsToMany(User::class, 'employe_projet', 'projet_id', 'employe_id')
                    ->withPivot('role_dans_projet', 'heures_prevues', 'heures_reelles')
                    ->withTimestamps();
    }

    public function taches()
    {
        return $this->hasMany(Tache::class);
    }

    public function calculerAvancement()
    {
        $totalTaches = $this->taches()->count();
        $tachesTerminees = $this->taches()->where('statut', Tache::STATUT_DONE)->count();

        if ($totalTaches > 0) {
            $this->avancement = round(($tachesTerminees / $totalTaches) * 100);
        } else {
            $this->avancement = 0;
        }
        $this->saveQuietly();

        return $this->avancement;
    }
}
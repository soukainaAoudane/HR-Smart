<?php
    namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


    class Tache extends Model{
    protected $fillable=[
        'titre',
        'description',
        'assignee_a',
        'cree_par',
        'projet_id',
        'competence_id',
        'duree_estimee',
        'deadline',
        'date_fin',
        'statut',
        'temps_reel_passe',
    ];

    protected $casts=[
        'deadline'=>'date',
        'date_fin'=>'date'
    ];

    const STATUT_TODO = 'todo';
    const STATUT_DOING = 'doing';
    const STATUT_DONE = 'done';

    public function assigne()
    {
        return $this->belongsTo(User::class, 'assignee_a');
    }

    public function createur()
    {
        return $this->belongsTo(User::class, 'cree_par');
    }

    public function projet()
    {
        return $this->belongsTo(Projet::class);
    }

    public function competence()
    {
        return $this->belongsTo(Competence::class);
    }

    public function isTodo()
    {
        return $this->statut === self::STATUT_TODO;
    }

    public function isDoing()
    {
        return $this->statut === self::STATUT_DOING;
    }

    public function isDone()
    {
        return $this->statut === self::STATUT_DONE;
    }

    public function getEstEnRetardAttribute()
    {
        if ($this->statut === self::STATUT_DONE) {
            return false;
        }
        return Carbon::now()->gt($this->deadline);
    }

}
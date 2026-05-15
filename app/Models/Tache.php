<?php
    namespace App\Models;

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

    public function assigne(){
        return $this->belongsTo(User::class, 'assignee_a');
    }

    public function createur(){
        return $this->belongsTo(User::class, 'cree_par');
    }

    public function projet(){
        return $this->belongsTo(Projet::class);
    }
    public function competence(){
        return $this->belongsTo(Competence::class);
    }
}

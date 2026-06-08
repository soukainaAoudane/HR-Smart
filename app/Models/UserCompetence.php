<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCompetence extends Model
{
    use HasFactory;

    protected $table = 'user_competences';

    protected $fillable = [
        'user_id',
        'competence_id',
        'niveau',
        'validee',
        'validee_par',
        'auto_detectee',
    ];

    protected $casts = [
        'validee' => 'boolean',
        'auto_detectee' => 'boolean',
    ];

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec la compétence
    public function competence()
    {
        return $this->belongsTo(Competence::class);
    }

    // Relation avec le validateur 
    public function validateur()
    {
        return $this->belongsTo(User::class, 'validee_par');
    }
}

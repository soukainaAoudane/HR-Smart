<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'categorie',
        'description',
        'is_critique',
    ];

    protected $casts = [
        'is_critique' => 'boolean',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_competences')
                    ->withPivot('niveau', 'validee', 'validee_par')
                    ->withTimestamps();
    }
}
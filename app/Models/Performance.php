<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mois',
        'annee',
        'taux_completion',
        'respect_delais',
        'score_global',
    ];

    protected $casts = [
        'taux_completion' => 'decimal:2',
        'respect_delais' => 'decimal:2',
        'score_global' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

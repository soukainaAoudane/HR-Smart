<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conge extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date_debut',
        'date_fin',
        'type',
        'statut',
        'motif',
        'commentaire_manager',
        'valide_par',
        'date_validation', 
        'justificatif',
    ];

    const TYPES = [
        'paye'       => 'Congé payé',
        'rtt'        => 'RTT',
        'sans_solde' => 'Congé sans solde',
        'formation'  => 'Congé formation',
    ];

    protected $casts = [
        'date_debut'      => 'date',
        'date_fin'        => 'date',
        'date_validation' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function validateur()
    {
        return $this->belongsTo(User::class, 'valide_par');
    }

    public function getTypeLabelAttribute()
    {
        return self::TYPES[$this->type] ?? $this->type;
    }

    public function isPaye()
    {
        return in_array($this->type, ['paye', 'rtt', 'formation']);
    }

    public function getDureeAttribute()
    {
        return $this->date_debut->diffInDays($this->date_fin) + 1;

    }
}
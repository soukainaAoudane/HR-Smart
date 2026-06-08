<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remplacement extends Model
{
    use HasFactory;

    /**
     * La table associée au modèle.
     */
    protected $table = 'remplacements';

    /**
     * Les attributs qui sont assignables en masse.
     */
    protected $fillable = [
        'conge_id',
        'deplacement_id',
        'remplacant_id',
        'score_matching',
        'statut',
        'propose_par',
        'date_reponse',
    ];

    /**
     * Les attributs qui doivent être convertis.
     */
    protected $casts = [
        'score_matching' => 'decimal:2',
        'date_reponse' => 'datetime',
    ];

    /**
     * Statuts disponibles.
     */
    const STATUT_PROPOSED = 'proposed';
    const STATUT_ACCEPTED = 'accepted';
    const STATUT_REFUSED = 'refused';

    /**
     * Relation avec le congé.
     */
    public function conge()
    {
        return $this->belongsTo(Conge::class);
    }

    /**
     * Relation avec le déplacement (optionnel).
     */
    public function deplacement()
    {
        return $this->belongsTo(Deplacement::class);
    }

    /**
     * Relation avec le remplaçant (employé qui remplace).
     */
    public function remplacant()
    {
        return $this->belongsTo(User::class, 'remplacant_id');
    }

    /**
     * Relation avec le proposeur (manager qui a proposé).
     */
    public function proposeur()
    {
        return $this->belongsTo(User::class, 'propose_par');
    }

    /**
     * Vérifier si la proposition est en attente.
     */
    public function isProposed()
    {
        return $this->statut === self::STATUT_PROPOSED;
    }

    /**
     * Vérifier si la proposition est acceptée.
     */
    public function isAccepted()
    {
        return $this->statut === self::STATUT_ACCEPTED;
    }

    /**
     * Vérifier si la proposition est refusée.
     */
    public function isRefused()
    {
        return $this->statut === self::STATUT_REFUSED;
    }

    /**
     * Obtenir le libellé du statut.
     */
    public function getStatutLabelAttribute()
    {
        return [
            self::STATUT_PROPOSED => 'Proposé',
            self::STATUT_ACCEPTED => 'Accepté',
            self::STATUT_REFUSED => 'Refusé',
        ][$this->statut] ?? $this->statut;
    }

    /**
     * Obtenir la couleur du statut (pour Bootstrap).
     */
    public function getStatutColorAttribute()
    {
        return [
            self::STATUT_PROPOSED => 'warning',
            self::STATUT_ACCEPTED => 'success',
            self::STATUT_REFUSED => 'danger',
        ][$this->statut] ?? 'secondary';
    }

    /**
     * Scope pour les propositions en attente.
     */
    public function scopeProposed($query)
    {
        return $query->where('statut', self::STATUT_PROPOSED);
    }

    /**
     * Scope pour les propositions acceptées.
     */
    public function scopeAccepted($query)
    {
        return $query->where('statut', self::STATUT_ACCEPTED);
    }

    /**
     * Scope pour les propositions refusées.
     */
    public function scopeRefused($query)
    {
        return $query->where('statut', self::STATUT_REFUSED);
    }

    /**
     * Scope pour un congé spécifique.
     */
    public function scopeForConge($query, $congeId)
    {
        return $query->where('conge_id', $congeId);
    }

    /**
     * Scope pour un remplaçant spécifique.
     */
    public function scopeForRemplacant($query, $remplacantId)
    {
        return $query->where('remplacant_id', $remplacantId);
    }

    /**
     * Accepter la proposition.
     */
    public function accepter()
    {
        $this->update([
            'statut' => self::STATUT_ACCEPTED,
            'date_reponse' => now(),
        ]);
    }

    /**
     * Refuser la proposition.
     */
    public function refuser()
    {
        $this->update([
            'statut' => self::STATUT_REFUSED,
            'date_reponse' => now(),
        ]);
    }
}
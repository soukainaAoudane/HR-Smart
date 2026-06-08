<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deplacement extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date_debut',
        'date_fin',
        'lieu',
        'adresse',
        'client',
        'contact_nom',
        'contact_telephone',
        'frais_transport',
        'frais_hebergement',
        'frais_repas',
        'frais_total',
        'vehicule',
        'statut',
        'motif',
        'commentaire_manager',
        'valide_par',
        'date_validation',
        'justificatif',
    ];

    protected $casts =[
        'date_debut'=>'date',
        'date_fin'=>'date',
        'date_validation'=>'date',
        'frais_transport'=>'decimal:2',
        'frais_hebergement'=>'decimal:2',
        'frais_repas'=>'decimal:2',
        'frais_total'=>'decimal:2',
    ];

    const VEHICULE_PERSONNEL = 'Personnel';
    const VEHICULE_SOCIETE = 'societe';

    const STATUT_PENDING='pending';
    const STATUT_APPROVED='approved';
    const STATUT_REFUSED   ='refused';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function validateur()
    {
        return $this->belongsTo(User::class, 'valide_par');
    }

    public function getDureeAttribute()
    {
        if(!$this->date_debut || !$this->date_fin){
            return 0;
        }
        return $this->date_debut->diffInDays($this->date_fin) + 1;
    }

    public function calculerFraisTotal(){
        $this->frais_total = $this->frais_transport + $this->frais_hebergement + $this->frais_repas;
        return $this->frais_total;
    }

    public function save(array $options = []){
        $this->calculerFraisTotal();
        parent::save($options);
    }
    
    public function isPending(){
        return $this->statut === self::STATUT_PENDING;
    }

    public function isApproved(){
        return $this->statut === self::STATUT_APPROVED;
    }

    public function isRefused(){
        return $this->statut === self::STATUT_REFUSED;
    }

    public function getStatutLabelAttribute()
    {
        return [
            self::STATUT_APPROVED => 'Approuvé',
            self::STATUT_REFUSED => 'Refusé',
            self::STATUT_PENDING => 'En attente',
            ][$this->statut] ?? $this->statut;
    }

    public function getVehiculeLabelAttribute(){
        return [
            self::VEHICULE_PERSONNEL=>'Personnel',
            self::VEHICULE_SOCIETE=>'Société',
             ][$this->vehicule] ?? $this->vehicule;
    }

    public function scopePending($query){
        return $query->where('statut', self::STATUT_PENDING);
    }

    public function scopeApproved($query){
        return $query->where('statut', self::STATUT_APPROVED);
    }

    public function scopeRefused($query){
        return $query->where('statut', self::STATUT_REFUSED);
    }
    
    public function scopeForMonth($query, $mois, $annee){
        return $query->whereYear('date_debut', $annee)
                     ->whereMonth('date_debut', $mois);
    }

    
}
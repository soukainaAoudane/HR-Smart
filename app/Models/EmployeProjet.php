<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeProjet extends Model
{
    use HasFactory;

    protected $table = 'employe_projet';

    protected $fillable = [
        'employe_id',
        'projet_id',
        'role_dans_projet',
        'heures_prevues',
        'heures_reelles',
    ];

    public function employe()
    {
        return $this->belongsTo(User::class, 'employe_id');
    }

    public function projet()
    {
        return $this->belongsTo(Projet::class);
    }
}
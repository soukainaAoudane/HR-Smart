<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Conge extends Model{
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
            'justificatif',
        ];

        protected $casts =[
            'date_debut' => 'date',
            'date_fin' => 'date',
            'date_validation' => 'date',
        ];

        public function user(){
            return $this->belongsTo(User::class);
        }

        public function validateur (){
            return $this->belongsTo(User::class, 'valide_par');
        }

        public function getDureeAttribute(){
            return $this->date_debut->diffInDays($this->date_fin) + 1; 

        }
    }

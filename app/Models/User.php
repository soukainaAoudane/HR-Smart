<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\ResetPasswordNotification;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'poste',
        'manager_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    public function isEmploye()
    {
        return $this->role === 'employe';
    }

    public function isManager()
    {
        return $this->role === 'manager';
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function employes()
    {
        return $this->hasMany(User::class, 'manager_id');
    }

    public function competences()
    {
        return $this->belongsToMany(Competence::class, 'user_competences')
            ->withPivot('niveau', 'validee', 'validee_par')
            ->withTimestamps();
    }

    public function competencesValidees()
    {
        return $this->competences()->wherePivot('validee', true);
    }

    public function competencesEnAttente()
    {
        return $this->competences()->wherePivot('validee', false);
    }

    public function sendPasswordResetNotification($token):void
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function conges()
    {
        return $this->hasMany(Conge::class);
    }

    public function congesEnAttente(){
        return $this->conges()->where('statut', 'pending');
    }

    public function congesApprouves(){
        return $this->conges()->where('statut', 'approved');
    }
}

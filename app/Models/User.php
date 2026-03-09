<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
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
        'is_temporary_password',
        'must_change_password',
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
            'password' => 'hashed',
            'is_temporary_password' => 'boolean',
            'must_change_password' => 'boolean',
        ];
    }
    
    /**
     * Relacionamento com Submission
     */
    public function submission()
    {
        return $this->hasOne(Submission::class);
    }
    
    /**
     * Verifica se o usuário é admin
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
    
    /**
     * Verifica se o usuário é município
     */
    public function isMunicipality()
    {
        return $this->role === 'municipality';
    }
    
    /**
     * Verifica se o usuário precisa trocar a senha
     */
    public function mustChangePassword()
    {
        return $this->must_change_password || $this->is_temporary_password;
    }
}

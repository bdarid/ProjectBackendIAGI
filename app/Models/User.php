<?php

namespace App\Models;

// ... tes autres use (HasFactory, Notifiable, etc.) ...

use Tymon\JWTAuth\Contracts\JWTSubject; // 1. AJOUTE CETTE LIGNE
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// 2. AJOUTE "implements JWTSubject" ICI
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // (Assure-toi que role est bien ici !)
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // ...

    // 3. AJOUTE CES DEUX FONCTIONS TOUT EN BAS DE LA CLASSE

    /**
     * Récupère l'identifiant de l'utilisateur pour le JWT.
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Permet d'ajouter des données personnalisées dans le Token.
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    public function profil()
    {
        return $this->hasOne(Profil::class);
    }
}

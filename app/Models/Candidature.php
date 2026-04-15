<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    use HasFactory;

    protected $fillable = ['offre_id', 'profil_id', 'message', 'statut'];
    /**
     * Une candidature appartient à un profil de candidat.
     */
    public function profil()
    {
        return $this->belongsTo(Profil::class);
    }

    /**
     * (Bonus) Ajoute aussi celle-ci si elle n'y est pas,
     * pour dire qu'une candidature appartient à une offre.
     */
    public function offre()
    {
        return $this->belongsTo(Offre::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profil extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'titre', 'bio', 'localisation', 'disponible'];

    /**
     * Relation avec l'utilisateur
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Relation avec les compétences (Many-to-Many)
     */
    public function competences()
    {
        return $this->belongsToMany(Competence::class, 'profil_competence')
            ->withPivot('niveau') // Permet d'accéder au champ 'débutant', 'expert', etc.
            ->withTimestamps();
    }
}

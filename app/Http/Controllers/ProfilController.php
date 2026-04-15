<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    // Voir son propre profil (avec ses compétences)
    public function show()
    {
        $profil = Auth::user()->profil()->with('competences')->first();

        if (!$profil) {
            return response()->json(['error' => 'Profil introuvable.'], 404);
        }

        return response()->json($profil, 200);
    }

    // Modifier/Remplir son profil (Puisqu'il est déjà créé vide à l'inscription)
    public function update(Request $request)
    {
        $profil = Auth::user()->profil;

        if (!$profil) {
            return response()->json(['error' => 'Profil introuvable.'], 404);
        }

        // On met à jour les champs que le candidat envoie
        $profil->update($request->only(['titre', 'bio', 'localisation']));

        return response()->json([
            'message' => 'Profil mis à jour avec succès',
            'profil' => $profil
        ], 200);
    }

    // Ajouter une compétence
    public function addCompetence(Request $request)
    {
        $request->validate([
            'competence_id' => 'required|exists:competences,id',
            'niveau' => 'required|in:débutant,intermédiaire,expert'
        ]);

        $profil = Auth::user()->profil;

        $profil->competences()->syncWithoutDetaching([
            $request->competence_id => ['niveau' => $request->niveau]
        ]);

        return response()->json(['message' => 'Compétence ajoutée avec succès.'], 200);
    }
}

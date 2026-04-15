<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\Offre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidatureController extends Controller
{
    // Le candidat postule à une offre
    public function postuler(Request $request, $id)
    {
        $profil = Auth::user()->profil;

        if (!$profil) {
            return response()->json(['error' => 'Vous devez créer un profil avant de postuler.'], 403);
        }

        // Empêcher de postuler deux fois à la même offre
        $dejaPostule = Candidature::where('offre_id', $id)->where('profil_id', $profil->id)->exists();
        if ($dejaPostule) {
            return response()->json(['error' => 'Vous avez déjà postulé à cette offre.'], 422);
        }

        $candidature = Candidature::create([
            'offre_id' => $id,
            'profil_id' => auth()->user()->profil->id,
            'message' => $request->message, // ou $request->input('message')
            'statut' => 'en attente',
        ]);

        return response()->json($candidature, 201);
    }

    // Le candidat regarde ses propres candidatures
    public function indexCandidat()
    {
        $profil = Auth::user()->profil;
        if (!$profil) return response()->json([], 200);

        // On charge les candidatures avec les détails de l'offre
        $candidatures = Candidature::with('offre')->where('profil_id', $profil->id)->get();
        return response()->json($candidatures, 200);
    }

    // Le recruteur regarde qui a postulé à son offre (RÈGLE 403)
    public function indexRecruteur($id)
    {
        $offre = Offre::findOrFail($id);

        if ($offre->user_id !== Auth::id()) {
            return response()->json(['error' => 'Accès interdit. Ce n\'est pas votre offre.'], 403);
        }

        $candidatures = Candidature::with('profil.user')->where('offre_id', $id)->get();
        return response()->json($candidatures, 200);
    }

    // Le recruteur accepte ou refuse une candidature (RÈGLE 403)
    public function updateStatut(Request $request, $id)
    {
        $request->validate(['statut' => 'required|in:en attente,acceptée,refusée']);

        $candidature = Candidature::findOrFail($id);

        // On vérifie que la personne connectée est bien le créateur de l'offre liée à la candidature
        if ($candidature->offre->user_id !== Auth::id()) {
            return response()->json(['error' => 'Accès interdit.'], 403);
        }

        $candidature->update(['statut' => $request->statut]);
        return response()->json($candidature, 200);
    }
}

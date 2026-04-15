<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OffreController extends Controller
{
    // Liste publique des offres (Filtres + Pagination 10)
    public function index(Request $request)
    {
        $query = Offre::where('actif', true);

        // Filtre par localisation
        if ($request->has('localisation')) {
            $query->where('localisation', 'like', '%' . $request->localisation . '%');
        }

        // Filtre par type (CDI, Stage, etc.)
        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        // Tri par les plus récentes, 10 par page
        $offres = $query->latest()->paginate(10);
        return response()->json($offres, 200);
    }

    // Détail d'une offre
    public function show($id)
    {
        $offre = Offre::findOrFail($id);
        return response()->json($offre, 200);
    }

    // Créer une offre (Le recruteur devient propriétaire)
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string',
            'description' => 'required|string',
            'localisation' => 'required|string',
            'type' => 'required|string'
        ]);

        $offre = Offre::create(array_merge(
            $request->all(),
            ['user_id' => Auth::id(), 'actif' => true]
        ));

        return response()->json($offre, 201);
    }

    // Modifier une offre (RÈGLE 403 : Seulement le créateur)
    public function update(Request $request, $id)
    {
        $offre = Offre::findOrFail($id);

        if ($offre->user_id !== Auth::id()) {
            return response()->json(['error' => 'Accès interdit. Vous n\'êtes pas l\'auteur de cette offre.'], 403);
        }

        $offre->update($request->all());
        return response()->json($offre, 200);
    }

    // Supprimer une offre (RÈGLE 403)
    public function destroy($id)
    {
        $offre = Offre::findOrFail($id);

        if ($offre->user_id !== Auth::id()) {
            return response()->json(['error' => 'Accès interdit.'], 403);
        }

        $offre->delete();
        return response()->json(['message' => 'Offre supprimée avec succès.'], 200);
    }
}

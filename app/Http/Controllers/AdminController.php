<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Voir tous les utilisateurs de la plateforme
    public function indexUsers()
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    // Supprimer un utilisateur définitivement
    public function destroyUser($id)
    {
        $user = User::findOrFail($id);

        // Empêcher l'admin de se suicider numériquement
        if ($user->id === auth()->id()) {
            return response()->json(['error' => 'Vous ne pouvez pas supprimer votre propre compte.'], 403);
        }

        $user->delete();
        return response()->json(['message' => 'L\'utilisateur a été banni et supprimé avec succès.'], 200);
    }
}

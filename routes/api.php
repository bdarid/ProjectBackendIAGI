<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Importation des contrôleurs de ton ami et des tiens
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| PARTIE 2 : AUTHENTIFICATION (Code de ton ami)
|--------------------------------------------------------------------------
*/
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth' // Toutes ces routes commencent par /api/auth/
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
    Route::get('/me', [AuthController::class, 'me'])->middleware('auth:api');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api');
});


/*
|--------------------------------------------------------------------------
| PARTIE 3 : TES ENDPOINTS (Ton code)
|--------------------------------------------------------------------------
*/

// 🟢 ROUTES PUBLIQUES (Accessibles sans Token)
Route::get('/offres', [OffreController::class, 'index']); // Liste des offres
Route::get('/offres/{id}', [OffreController::class, 'show']); // Détail d'une offre


// 🔴 ROUTES PROTÉGÉES (Nécessitent le Token JWT)
Route::middleware('auth:api')->group(function () {

    // --- PÔLE CANDIDAT ---
    Route::get('/profil/me', [ProfilController::class, 'show']);
    Route::put('/profil', [ProfilController::class, 'update']);
    Route::post('/profil/competences', [ProfilController::class, 'addCompetence']);

    // Candidater
    Route::post('/offres/{id}/postuler', [CandidatureController::class, 'postuler']);
    Route::get('/mes-candidatures', [CandidatureController::class, 'indexCandidat']);


    // --- PÔLE RECRUTEUR ---
    Route::post('/offres', [OffreController::class, 'store']);
    Route::put('/offres/{id}', [OffreController::class, 'update']);
    Route::delete('/offres/{id}', [OffreController::class, 'destroy']);

    // Gérer les candidatures
    Route::get('/offres/{id}/candidatures', [CandidatureController::class, 'indexRecruteur']);
    Route::patch('/candidatures/{id}/statut', [CandidatureController::class, 'updateStatut']);


    // --- PÔLE ADMIN ---
    Route::get('/admin/users', [AdminController::class, 'indexUsers']);
    Route::delete('/admin/users/{id}', [AdminController::class, 'destroyUser']);
});

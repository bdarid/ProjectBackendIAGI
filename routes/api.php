<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Importation de tous les contrôleurs
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// ─────────────────────────────────────────────────────────────────────────────
// ROUTES PUBLIQUES (Accessibles sans authentification)
// ─────────────────────────────────────────────────────────────────────────────
Route::prefix('auth')->group(function () {
    Route::post('/login',    [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});

// Consultation des offres (Généralement public)
Route::get('/offres', [OffreController::class, 'index']); // Liste des offres
Route::get('/offres/{id}', [OffreController::class, 'show']); // Détail d'une offre


// ─────────────────────────────────────────────────────────────────────────────
// ROUTES PROTÉGÉES — Nécessitent le Token JWT (auth:api)
// ─────────────────────────────────────────────────────────────────────────────
Route::middleware('auth:api')->group(function () {

    // --- GESTION DU COMPTE (Toutes personnes connectées) ---
    Route::prefix('auth')->group(function () {
        Route::post('/logout',  [AuthController::class, 'logout']);
        Route::get('/me',       [AuthController::class, 'me']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
    });


    // ─────────────────────────────────────────────────────────────────────────
    // PÔLE CANDIDAT (Réservé aux candidats)
    // ─────────────────────────────────────────────────────────────────────────
    Route::middleware('role:candidat')->group(function () {

        // Gestion du profil
        Route::get('/profil/me', [ProfilController::class, 'show']);
        Route::put('/profil', [ProfilController::class, 'update']);
        Route::post('/profil/competences', [ProfilController::class, 'addCompetence']);

        // Candidatures
        Route::post('/offres/{id}/postuler', [CandidatureController::class, 'postuler']);
        Route::get('/mes-candidatures', [CandidatureController::class, 'indexCandidat']);
    });


    // ─────────────────────────────────────────────────────────────────────────
    // PÔLE RECRUTEUR (Réservé aux recruteurs)
    // ─────────────────────────────────────────────────────────────────────────
    Route::middleware('role:recruteur')->group(function () {

        // Gestion des offres d'emploi
        Route::post('/offres', [OffreController::class, 'store']);
        Route::put('/offres/{id}', [OffreController::class, 'update']);
        Route::delete('/offres/{id}', [OffreController::class, 'destroy']);

        // Gestion des candidatures reçues
        Route::get('/offres/{id}/candidatures', [CandidatureController::class, 'indexRecruteur']);
        Route::patch('/candidatures/{id}/statut', [CandidatureController::class, 'updateStatut']);
    });


    // ─────────────────────────────────────────────────────────────────────────
    // PÔLE ADMIN (Réservé aux administrateurs)
    // ─────────────────────────────────────────────────────────────────────────
    Route::middleware('role:admin')->group(function () {

        // Gestion des utilisateurs et de la plateforme
        Route::get('/admin/users', [AdminController::class, 'indexUsers']);
        Route::delete('/admin/users/{id}', [AdminController::class, 'destroyUser']);
    });

});

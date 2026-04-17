<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Routes publiques (sans authentification) — login / register
| Routes protégées par JWT (auth:api)
| Routes protégées par rôle (role:admin, role:recruteur, etc.)
|
*/

// ─────────────────────────────────────────────────────────────────────────────
// Routes publiques — Authentification
// ─────────────────────────────────────────────────────────────────────────────
Route::prefix('auth')->group(function () {
    Route::post('/login',    [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});

// ─────────────────────────────────────────────────────────────────────────────
// Routes protégées — Authentification JWT requise
// ─────────────────────────────────────────────────────────────────────────────
Route::prefix('auth')->middleware('auth:api')->group(function () {
    Route::post('/logout',  [AuthController::class, 'logout']);
    Route::get('/me',       [AuthController::class, 'me']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
});

// ─────────────────────────────────────────────────────────────────────────────
// Routes protégées — Accessibles à tous les utilisateurs authentifiés
// (candidat, recruteur, admin)
// ─────────────────────────────────────────────────────────────────────────────
Route::middleware('auth:api')->group(function () {

    // Exemple : profil candidat (accessible à tous les rôles authentifiés)
    // Route::apiResource('profils', ProfilController::class);

    // ─────────────────────────────────────────────────────────────────────────
    // Routes réservées aux Recruteurs et Admins
    // ─────────────────────────────────────────────────────────────────────────
    Route::middleware('role:recruteur,admin')->group(function () {
        // Exemple : gestion des offres d'emploi
        // Route::apiResource('offres', OffreController::class);
    });

    // ─────────────────────────────────────────────────────────────────────────
    // Routes réservées aux Admins uniquement
    // ─────────────────────────────────────────────────────────────────────────
    Route::middleware('role:admin')->group(function () {
        // Exemple : gestion des utilisateurs
        // Route::get('users', [UserController::class, 'index']);
        // Route::delete('users/{user}', [UserController::class, 'destroy']);
    });

    // ─────────────────────────────────────────────────────────────────────────
    // Routes réservées aux Candidats uniquement
    // ─────────────────────────────────────────────────────────────────────────
    Route::middleware('role:candidat')->group(function () {
        // Exemple : gestion des candidatures
        // Route::apiResource('candidatures', CandidatureController::class);
    });
});

<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Authentifie un utilisateur et retourne un token JWT.
     */
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $credentials = $request->only('email', 'password');

        try {
            if (!$token = auth('api')->attempt($credentials)) {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['message' => 'Could not create token'], 500);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Crée un nouvel utilisateur et retourne un token JWT.
     */
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role'     => 'nullable|in:candidat,recruteur',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $role = $request->role ?? 'candidat'; // Rôle par défaut : candidat

            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => $request->password,
                'role'     => $role,
            ]);

            // Créer un profil si l'utilisateur est un candidat
            if ($role === 'candidat') {
                Profil::create([
                    'user_id'     => $user->id,
                    'titre'       => '',
                    'bio'         => '',
                    'localisation' => '',
                ]);
            }

            $token = JWTAuth::fromUser($user);

            return response()->json([
                'message' => 'User created successfully',
                'user'    => $user,
                'token'   => $token,
                'token_type' => 'Bearer',
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error creating user', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Invalide le token JWT (logout).
     */
    public function logout(): JsonResponse
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json(['message' => 'User logged out successfully'], 200);
        } catch (JWTException $e) {
            return response()->json(['message' => 'Failed to logout'], 500);
        }
    }

    /**
     * Retourne les informations de l'utilisateur connecté.
     */
    public function me(): JsonResponse
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => 'User not found'], 404);
            }

            return response()->json(['user' => $user], 200);
        } catch (JWTException $e) {
            return response()->json(['message' => 'Invalid token'], 401);
        }
    }

    /**
     * Rafraîchit le token JWT.
     */
    public function refresh(): JsonResponse
    {
        try {
            $token = JWTAuth::refresh(JWTAuth::getToken());

            return $this->respondWithToken($token);
        } catch (JWTException $e) {
            return response()->json(['message' => 'Could not refresh token'], 500);
        }
    }

    /**
     * Formate la réponse avec le token JWT.
     */
    protected function respondWithToken(string $token): JsonResponse
    {
        return response()->json([
            'message'    => 'User authenticated successfully',
            'token'      => $token,
            'user'       => auth('api')->user(),
            'token_type' => 'Bearer',
            'expires_in' => config('jwt.ttl') * 60, // in seconds
        ]);
    }
}

<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     * Register a new user.
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => User::ROLE_USER,
            ]);

            // Déclencher l'événement d'inscription
            event(new Registered($user));

            // Créer un token d'authentification
            $token = $user->createToken('auth_token')->plainTextToken;

            Log::info('Nouvel utilisateur inscrit', ['user_id' => $user->id, 'email' => $user->email]);

            return response()->json([
                'success' => true,
                'message' => 'Inscription réussie. Veuillez vérifier votre email.',
                'data' => [
                    'user' => new UserResource($user),
                    'token' => $token,
                    'token_type' => 'Bearer',
                ],
            ], 201);

        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'inscription', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de l\'inscription.',
            ], 500);
        }
    }

    /**
     * Login user.
     */
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $request->authenticate();

            $user = Auth::user();
            
            // Révoquer tous les tokens existants
            $user->tokens()->delete();
            
            // Créer un nouveau token
            $token = $user->createToken('auth_token')->plainTextToken;

            Log::info('Utilisateur connecté', ['user_id' => $user->id, 'email' => $user->email]);

            return response()->json([
                'success' => true,
                'message' => 'Connexion réussie.',
                'data' => [
                    'user' => new UserResource($user),
                    'token' => $token,
                    'token_type' => 'Bearer',
                ],
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur lors de la connexion', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la connexion.',
            ], 401);
        }
    }

    /**
     * Logout user.
     */
    public function logout(Request $request): JsonResponse
    {
        try {
            $user = $request->user();
            
            // Révoquer le token actuel
            $request->user()->currentAccessToken()->delete();

            Log::info('Utilisateur déconnecté', ['user_id' => $user->id]);

            return response()->json([
                'success' => true,
                'message' => 'Déconnexion réussie.',
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur lors de la déconnexion', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la déconnexion.',
            ], 500);
        }
    }

    /**
     * Get authenticated user.
     */
    public function me(Request $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => new UserResource($request->user()),
        ]);
    }

    /**
     * Refresh token.
     */
    public function refresh(Request $request): JsonResponse
    {
        try {
            $user = $request->user();
            
            // Révoquer le token actuel
            $request->user()->currentAccessToken()->delete();
            
            // Créer un nouveau token
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Token rafraîchi avec succès.',
                'data' => [
                    'token' => $token,
                    'token_type' => 'Bearer',
                ],
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur lors du rafraîchissement du token', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Erreur lors du rafraîchissement du token.',
            ], 500);
        }
    }
}

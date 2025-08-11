<?php

namespace App\Http\Controllers\API\Auth\AuthUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request): JsonResponse
    {
        try {
            $request->authenticate();
            $user = Auth::user();
            $user->tokens()->delete();
            $token = $user->createToken('auth_token')->plainTextToken;

            Log::info('Connexion réussie', ['user_id' => $user->id]);

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
            Log::error('Erreur connexion', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Email ou mot de passe invalide',
            ], 401);
        }
    }
}

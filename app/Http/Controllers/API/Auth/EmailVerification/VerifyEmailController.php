<?php

namespace App\Http\Controllers\API\Auth\EmailVerification;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VerifyEmailController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'id' => 'required|integer',
                'hash' => 'required|string',
                'expires' => 'required|integer',
                'signature' => 'required|string',
            ]);

            $user = User::find($request->input('id'));

            if (! $user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Utilisateur introuvable.',
                ], 404);
            }

            if ($user->hasVerifiedEmail()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email déjà vérifié.',
                ], 400);
            }

            if (! hash_equals(sha1($user->getEmailForVerification()), $request->input('hash'))) {
                return response()->json([
                    'success' => false,
                    'message' => 'Lien de vérification invalide.',
                ], 400);
            }

            if ($request->input('expires') < time()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Lien de vérification expiré.',
                ], 400);
            }

            if ($user->markEmailAsVerified()) {
                event(new Verified($user));
            }

            return response()->json([
                'success' => true,
                'message' => 'Email vérifié avec succès.',
                'data' => [
                    'user' => $user,
                    'token' => $user->createToken('auth_token')->plainTextToken,
                    'token_type' => 'Bearer',
                ],
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur vérification email', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la vérification.',
            ], 500);
        }
    }
}

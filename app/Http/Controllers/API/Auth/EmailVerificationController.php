<?php

namespace App\Http\Controllers\API\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Config;

class EmailVerificationController extends Controller
{
    /**
     * Send email verification notification.
     */
    public function send(Request $request): JsonResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json([
                'success' => false,
                'message' => 'Email déjà vérifié.',
            ], 400);
        }

        $request->user()->sendEmailVerificationNotification();

        return response()->json([
            'success' => true,
            'message' => 'Email de vérification envoyé.',
        ]);
    }

    /**
     * Verify email with URL parameters.
     */
    public function verify(Request $request): JsonResponse
    {
        try{
            $request->validate([
                'id' => 'required|integer',
                'hash' => 'required|string',
                'expires' => 'required|integer',
                'signature' => 'required|string',
            ]);
    
            $user = User::find($request->input('id'));
    
            // Vérifier si l'utilisateur correspond à l'ID
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Utilisateur introuvable.',
                ], 404);
            }
    
            // Vérifier si l'email est déjà vérifié
            if ($user->hasVerifiedEmail()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email déjà vérifié.',
                ], 400);
            }
    
            // Vérifier le hash
            if (!hash_equals(sha1($user->getEmailForVerification()), $request->input('hash'))) {
                return response()->json([
                    'success' => false,
                    'message' => 'Lien de vérification invalide.',
                ], 400);
            }
    
            // Vérifier l'expiration
            if ($request->input('expires') < time()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Lien de vérification expiré.',
                ], 400);
            }
    
    
            // Marquer l'email comme vérifié
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
            ], 200);

        }catch(Exception $e){
            Log::info($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Check email verification status.
     */
    public function status(Request $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'verified' => $request->user()->hasVerifiedEmail(),
            'email' => $request->user()->email,
            'verified_at' => $request->user()->email_verified_at,
        ]);
    }
}

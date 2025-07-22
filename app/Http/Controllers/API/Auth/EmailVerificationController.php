<?php

namespace App\Http\Controllers\API\Auth;

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
        $request->validate([
            'id' => 'required|integer',
            'hash' => 'required|string',
            'expires' => 'required|integer',
            'signature' => 'required|string',
        ]);

        // Vérifier si l'utilisateur correspond à l'ID
        if ($request->user()->getKey() != $request->input('id')) {
            return response()->json([
                'success' => false,
                'message' => 'Utilisateur non autorisé.',
            ], 403);
        }

        // Vérifier si l'email est déjà vérifié
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json([
                'success' => false,
                'message' => 'Email déjà vérifié.',
            ], 400);
        }

        // Vérifier le hash
        if (!hash_equals(
            sha1($request->user()->getEmailForVerification()),
            $request->input('hash')
        )) {
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

        // Vérifier la signature
        $url = URL::temporarySignedRoute(
            'verification.verify',
            $request->input('expires'),
            [
                'id' => $request->input('id'),
                'hash' => $request->input('hash'),
            ]
        );

        $expectedSignature = parse_url($url, PHP_URL_QUERY);
        parse_str($expectedSignature, $expectedParams);
        
        if ($expectedParams['signature'] !== $request->input('signature')) {
            return response()->json([
                'success' => false,
                'message' => 'Signature invalide.',
            ], 400);
        }

        // Marquer l'email comme vérifié
        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return response()->json([
            'success' => true,
            'message' => 'Email vérifié avec succès.',
            'user' => $request->user()->fresh(),
        ]);
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

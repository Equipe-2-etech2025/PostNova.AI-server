<?php
namespace App\Http\Controllers\API\Auth\AuthUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogoutController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        try {
            $user = $request->user();
            $request->user()->currentAccessToken()->delete();

            Log::info('Déconnexion', ['user_id' => $user->id]);

            return response()->json([
                'success' => true,
                'message' => 'Déconnexion réussie.',
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur déconnexion', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la déconnexion',
            ], 500);
        }
    }
}

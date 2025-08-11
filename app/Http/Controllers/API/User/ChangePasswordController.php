<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class ChangePasswordController extends Controller
{
    public function __construct(
        private readonly UserServiceInterface $userService
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'currentPassword' => 'required|string',
            'newPassword' => 'required|string|min:6|confirmed',
        ]);

        try {
            $userId = auth()->id();

            $this->userService->changePassword(
                $userId,
                $validated['currentPassword'],
                $validated['newPassword']
            );

            return response()->json(
                [
                    'success'=> true,
                    'message' => 'Mot de passe modifié avec succès.',
                ]
            );
        } catch (\Throwable $e) {
            Log::error('Erreur changement mot de passe: ' . $e->getMessage());

            return response()->json([
                'success'=> false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}

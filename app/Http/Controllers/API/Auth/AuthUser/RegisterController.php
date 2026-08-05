<?php

namespace App\Http\Controllers\API\Auth\AuthUser;

use App\DTOs\TarifUser\TarifUserDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Services\Interfaces\TarifUserServiceInterface;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    protected TarifUserServiceInterface $tarifUserService;

    public function __construct(TarifUserServiceInterface $tarifUserService)
    {
        $this->tarifUserService = $tarifUserService;
    }

    public function __invoke(RegisterRequest $request): JsonResponse
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'role' => User::ROLE_USER,
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            $tarifUserDto = new TarifUserDto(
                null,
                1,
                $user->id,
                now(),
                null,
            );
            $this->tarifUserService->createTarifUser($tarifUserDto);

            try {
                event(new Registered($user));
                Log::info('Email de vérification envoyé', ['user_id' => $user->id]);
            } catch (\Exception $emailError) {
                Log::warning('Email de vérification non envoyé', [
                    'user_id' => $user->id,
                    'error' => $emailError->getMessage()
                ]);
            }

            Log::info('Nouvel utilisateur inscrit', ['user_id' => $user->id]);

            return response()->json([
                'success' => true,
                'message' => 'Inscription réussie. Un email de vérification vous a été envoyé.',
                'data' => [
                    'user' => new UserResource($user),
                    'token' => $token,
                    'token_type' => 'Bearer',
                ],
            ], 201);
        } catch (\Exception $e) {
            Log::error('Erreur inscription', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
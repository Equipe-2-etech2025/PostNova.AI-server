<?php
namespace App\Http\Controllers\API\Auth\AuthUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Services\Interfaces\TarifUserServiceInterface;
use App\DTOs\TarifUser\TarifUserDto;

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

            event(new Registered($user));
            $token = $user->createToken('auth_token')->plainTextToken;

            $tarifUserDto = new TarifUserDto(
                null,
                1, // ID du tarif par défaut ("Free")
                $user->id,
                now(),
                null,
            );
            $this->tarifUserService->createTarifUser($tarifUserDto);

            Log::info('Nouvel utilisateur inscrit', ['user_id' => $user->id]);

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
            Log::error('Erreur inscription', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}

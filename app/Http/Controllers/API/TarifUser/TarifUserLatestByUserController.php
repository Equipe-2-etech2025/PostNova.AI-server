<?php

namespace App\Http\Controllers\API\TarifUser;

use App\Http\Controllers\Controller;
use App\Http\Resources\Tarif\TarifResource;
use App\Models\TarifUser;
use App\Models\User;
use App\Services\Interfaces\TarifUserServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

class TarifUserLatestByUserController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly TarifUserServiceInterface $service
    ) {}

    public function __invoke(int $userId): JsonResponse|TarifResource
    {
        User::findOrFail($userId);

        $latestTarif = $this->service->getLatestByUserId($userId);
        $this->authorize('viewLatest', $latestTarif);

        if (!$latestTarif) {
            return response()->json([
                'success' => true,
                'data' => null,
                'message' => 'Aucun tarif trouvé pour cet utilisateur.'
            ], 200);
        }
        return new TarifResource($latestTarif);
    }
}

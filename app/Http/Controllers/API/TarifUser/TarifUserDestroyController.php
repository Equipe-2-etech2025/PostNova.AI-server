<?php

namespace App\Http\Controllers\API\TarifUser;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\TarifUserServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

class TarifUserDestroyController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private TarifUserServiceInterface $service
    ) {}

    public function __invoke(int $id): JsonResponse
    {
        $tarifUser = $this->service->getTarifUserById($id);
        $this->authorize('delete', $tarifUser);
        $this->service->deleteTarifUser($id);

        return response()->json(['message' => 'Supprimé avec succès.'], 200);
    }
}

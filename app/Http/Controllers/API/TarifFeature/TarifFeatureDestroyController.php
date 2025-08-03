<?php

namespace App\Http\Controllers\API\TarifFeature;

use App\Http\Controllers\Controller;
use App\Models\TarifFeature;
use App\Services\Interfaces\TarifFeatureServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

class TarifFeatureDestroyController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly TarifFeatureServiceInterface $service
    ) {}

    public function __invoke(int $id): JsonResponse
    {
        $tarifFeature = $this->service->getTarifFeatureById($id);
        $this->authorize('delete', $tarifFeature);
        $this->service->deleteTarifFeature($id);
        return response()->json(['message' => 'Supprimé avec succès.'], 200);
    }
}

<?php

namespace App\Http\Controllers\API\Features;

use App\Http\Controllers\Controller;
use App\Models\Features;
use App\Services\Interfaces\FeaturesServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

class FeaturesDestroyController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly FeaturesServiceInterface $service
    ) {}

    public function __invoke(int $id): JsonResponse
    {
        $feature = $this->service->getFeatureById($id);
        $this->authorize('delete', $feature);
        $this->service->deleteFeature($id);

        return response()->json(['message' => 'Supprimé avec succès.'], 200);
    }
}

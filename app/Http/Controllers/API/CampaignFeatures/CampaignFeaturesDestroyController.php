<?php

namespace App\Http\Controllers\API\CampaignFeatures;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\CampaignFeaturesServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

class CampaignFeaturesDestroyController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly CampaignFeaturesServiceInterface $service
    ) {}

    public function __invoke(int $id): JsonResponse
    {
        $feature = $this->service->getById($id);
        $this->authorize('delete', $feature);
        $this->service->delete($id);

        return response()->json(['message' => 'Supprimé avec succès.'], 200);
    }
}

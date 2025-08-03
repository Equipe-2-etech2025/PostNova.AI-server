<?php

namespace App\Http\Controllers\API\Campaign;

use App\Http\Controllers\Controller;
use App\Http\Resources\Campaign\CampaignCollection;
use App\Models\TypeCampaign;
use App\Services\Interfaces\CampaignServiceInterface;
use Illuminate\Http\JsonResponse;

class CampaignByTypeController extends Controller
{
    public function __construct(
        private readonly CampaignServiceInterface $campaignService
    ) {}

    /**
     * Get campaigns by type ID
     */
    public function __invoke(int $typeId): CampaignCollection|JsonResponse
    {
        $type = TypeCampaign::find($typeId);

        if (!$type) {
            return response()->json([
                'message' => 'Type de campagne non trouvé'
            ], 404);
        }

        $campaigns = $this->campaignService->getCampaignsByType($typeId);

        return new CampaignCollection($campaigns);
    }
}

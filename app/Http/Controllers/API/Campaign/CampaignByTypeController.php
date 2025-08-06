<?php

namespace App\Http\Controllers\API\Campaign;

use App\Http\Controllers\Controller;
use App\Http\Resources\Campaign\CampaignCollection;
use App\Models\TypeCampaign;
use App\Models\Campaign;
use App\Services\Interfaces\CampaignServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

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

        $filteredCampaigns = $campaigns->filter(function ($campaign) {
            return Gate::allows('view', $campaign);
        });

        return new CampaignCollection($filteredCampaigns);

    }
}

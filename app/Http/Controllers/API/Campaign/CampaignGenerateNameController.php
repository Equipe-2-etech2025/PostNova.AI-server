<?php

namespace App\Http\Controllers\API\Campaign;

use App\Http\Controllers\Controller;
use App\Services\CampaignCreateService\CampaignCreatorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CampaignGenerateNameController extends Controller
{
    public function __construct(
        private readonly CampaignCreatorService $campaignCreatorService
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'description' => ['required', 'string'],
            'type_campaign_id' => ['required', 'int', 'exists:type_campaigns,id'],
            'user_id' => ['required', 'int', 'exists:users,id'],
        ]);

        $campaign = $this->campaignCreatorService->createCampaignFromDescription($validated);

        return response()->json([
            'success' => true,
            'campaign' => $campaign,
        ]);
    }
}

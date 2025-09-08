<?php

namespace App\Http\Controllers\API\CampaignInteraction;

use App\Http\Controllers\Controller;
use App\Models\CampaignInteraction;
use App\Services\Interfaces\CampaignInteractionServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CampaignInteractionStatsController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private CampaignInteractionServiceInterface $service
    ) {}

    public function __invoke(int $campaignId)
    {
        $interaction = CampaignInteraction::where('campaign_id', $campaignId)->first();
        // $this->authorize('view', $interaction);

        return response()->json([
            'likes' => $this->service->getCampaignTotalLikes($campaignId),
            'views' => $this->service->getCampaignTotalViews($campaignId),
            'shares' => $this->service->getCampaignTotalShares($campaignId),
        ]);
    }
}

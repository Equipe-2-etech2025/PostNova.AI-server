<?php

namespace App\Http\Controllers\API\CampaignInteraction;

use App\Http\Controllers\Controller;
use App\Http\Resources\CampaignInteraction\CampaignInteractionCollection;
use App\Models\CampaignInteraction;
use App\Services\Interfaces\CampaignInteractionServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CampaignInteractionIndexController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private CampaignInteractionServiceInterface $service
    ) {}

    public function __invoke()
    {
        $this->authorize('viewAny', CampaignInteraction::class);
        $interactions = $this->service->getAllInteractions();

        return new CampaignInteractionCollection($interactions);
    }
}

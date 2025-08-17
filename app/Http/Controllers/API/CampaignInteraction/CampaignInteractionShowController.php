<?php

namespace App\Http\Controllers\API\CampaignInteraction;

use App\Http\Controllers\Controller;
use App\Http\Resources\CampaignInteraction\CampaignInteractionResource;
use App\Services\Interfaces\CampaignInteractionServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CampaignInteractionShowController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private CampaignInteractionServiceInterface $service
    ) {}

    public function __invoke(int $id)
    {
        $interaction = $this->service->getInteractionById($id);
        $this->authorize('view', $interaction);

        return new CampaignInteractionResource($interaction);
    }
}

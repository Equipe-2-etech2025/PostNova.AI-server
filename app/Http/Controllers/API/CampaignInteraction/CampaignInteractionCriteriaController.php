<?php

namespace App\Http\Controllers\API\CampaignInteraction;

use App\Http\Controllers\Controller;
use App\Http\Resources\CampaignInteraction\CampaignInteractionCollection;
use App\Models\CampaignInteraction;
use App\Services\Interfaces\CampaignInteractionServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class CampaignInteractionCriteriaController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private CampaignInteractionServiceInterface $service
    ) {}

    public function __invoke(Request $request)
    {
        $this->authorize('viewAny', CampaignInteraction::class);
        $criteria = $request->query();

        $results = $this->service->getInteractionsByCriteria($criteria);

        return new CampaignInteractionCollection($results);
    }
}

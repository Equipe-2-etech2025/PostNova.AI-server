<?php

namespace App\Http\Controllers\API\CampaignFeatures;

use App\Http\Controllers\Controller;
use App\Http\Resources\CampaignFeatures\CampaignFeaturesResource;
use App\Services\Interfaces\CampaignFeaturesServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CampaignFeaturesShowController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly CampaignFeaturesServiceInterface $service
    ) {}

    public function __invoke(int $id)
    {
        $feature = $this->service->getById($id);
        $this->authorize('view', $feature);

        return new CampaignFeaturesResource($feature);
    }
}

<?php

namespace App\Http\Controllers\API\CampaignFeatures;

use App\Http\Controllers\Controller;
use App\Http\Resources\CampaignFeatures\CampaignFeaturesCollection;
use App\Models\CampaignFeatures;
use App\Services\Interfaces\CampaignFeaturesServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CampaignFeaturesIndexController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly CampaignFeaturesServiceInterface $service
    ) {}

    public function __invoke()
    {
        $this->authorize('viewAny', CampaignFeatures::class);
        $features = $this->service->getAll();
        return new CampaignFeaturesCollection($features);
    }
}

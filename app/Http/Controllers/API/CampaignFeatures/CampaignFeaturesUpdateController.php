<?php

namespace App\Http\Controllers\API\CampaignFeatures;

use App\Http\Controllers\Controller;
use App\Http\Requests\CampaignFeatures\UpdateCampaignFeaturesRequest;
use App\Http\Resources\CampaignFeatures\CampaignFeaturesResource;
use App\Models\CampaignFeatures;
use App\Services\Interfaces\CampaignFeaturesServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CampaignFeaturesUpdateController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly CampaignFeaturesServiceInterface $service
    ) {}

    public function __invoke(UpdateCampaignFeaturesRequest $request, int $id)
    {
        $feature = $this->service->getById($id);
        $this->authorize('update', $feature);
        $updated = $this->service->update($id, $request->toDto($feature));
        return new CampaignFeaturesResource($updated);
    }
}

<?php

namespace App\Http\Controllers\API\CampaignFeatures;

use App\Http\Controllers\Controller;
use App\Http\Requests\CampaignFeatures\CreateCampaignFeaturesRequest;
use App\Http\Resources\CampaignFeatures\CampaignFeaturesResource;
use App\Models\CampaignFeatures;
use App\Services\Interfaces\CampaignFeaturesServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CampaignFeaturesStoreController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly CampaignFeaturesServiceInterface $service
    ) {}

    public function __invoke(CreateCampaignFeaturesRequest $request)
    {
        $this->authorize('create', CampaignFeatures::class);
        $created = $this->service->create($request->toDto());
        return new CampaignFeaturesResource($created);
    }
}

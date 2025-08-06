<?php

namespace App\Http\Controllers\API\Campaign;

use App\Http\Controllers\Controller;
use App\Http\Requests\Campaign\CreateCampaignRequest;
use App\Http\Resources\Campaign\CampaignResource;
use App\Models\Campaign;
use App\Services\Interfaces\CampaignServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CampaignStoreController extends Controller
{
    use AuthorizesRequests;

    private CampaignServiceInterface $campaignService;

    public function __construct(CampaignServiceInterface $campaignService)
    {
        $this->campaignService = $campaignService;
    }

    public function __invoke(CreateCampaignRequest $request)
    {
        $campaignDto = $request->toDto();
        $campaign = $this->campaignService->createCampaign($campaignDto);
        $this->authorize('create', $campaign);

        return new CampaignResource($campaign);
    }
}

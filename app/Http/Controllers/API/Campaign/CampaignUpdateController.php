<?php

namespace App\Http\Controllers\API\Campaign;

use App\Http\Controllers\Controller;
use App\Http\Requests\Campaign\UpdateCampaignRequest;
use App\Http\Resources\Campaign\CampaignResource;
use App\Services\Interfaces\CampaignServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CampaignUpdateController extends Controller
{
    use AuthorizesRequests;

    private CampaignServiceInterface $campaignService;

    public function __construct(CampaignServiceInterface $campaignService)
    {
        $this->campaignService = $campaignService;
    }

    public function __invoke(UpdateCampaignRequest $request, int $id)
    {
        $campaign = $this->campaignService->getCampaignById($id);
        $this->authorize('update', $campaign);
        $campaignDto = $request->toDto($campaign);
        $updated = $this->campaignService->updateCampaign($id, $campaignDto);
        return new CampaignResource($updated);
    }
}

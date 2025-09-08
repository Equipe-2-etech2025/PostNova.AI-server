<?php

namespace App\Http\Controllers\API\Campaign;

use App\Http\Controllers\Controller;
use App\Http\Resources\Campaign\CampaignResource;
use App\Services\Interfaces\CampaignServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CampaignShowController extends Controller
{
    use AuthorizesRequests;

    private CampaignServiceInterface $campaignService;

    public function __construct(CampaignServiceInterface $campaignService)
    {
        $this->campaignService = $campaignService;
    }

    public function __invoke(int $id)
    {
        $campaign = $this->campaignService->getCampaignById($id);
        //$this->authorize('view', $campaign);

        return new CampaignResource($campaign);
    }
}

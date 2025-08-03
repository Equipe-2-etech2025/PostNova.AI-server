<?php

namespace App\Http\Controllers\API\Campaign;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\CampaignServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CampaignDestroyController extends Controller
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
        $this->authorize('delete', $campaign);
        $this->campaignService->deleteCampaign($id);

        return response()->json(['message' => 'Supprimé avec succès.'], 200);
    }
}

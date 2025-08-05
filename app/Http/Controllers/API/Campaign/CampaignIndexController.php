<?php

namespace App\Http\Controllers\API\Campaign;

use App\Http\Controllers\Controller;
use App\Http\Resources\Campaign\CampaignCollection;
use App\Models\Campaign;
use App\Services\Interfaces\CampaignServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CampaignIndexController extends Controller
{
    use AuthorizesRequests;

    private CampaignServiceInterface $campaignService;

    public function __construct(CampaignServiceInterface $campaignService)
    {
        $this->campaignService = $campaignService;
    }

    public function __invoke(Request $request)
    {
        $user = Auth::user();
        $this->authorize('viewAny', Campaign::class);

        if ($user->hasRole('admin')) {
            $campaigns = $this->campaignService->getAllCampaigns();
        } else {
            $campaigns = $this->campaignService->getAllCampaigns();
        }

        return new CampaignCollection($campaigns);
    }
}

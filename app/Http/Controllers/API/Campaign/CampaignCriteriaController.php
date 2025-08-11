<?php

namespace App\Http\Controllers\API\Campaign;

use App\Http\Controllers\Controller;
use App\Http\Resources\Campaign\CampaignCollection;
use App\Models\Campaign;
use App\Services\Interfaces\CampaignServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CampaignCriteriaController extends Controller
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

        $criteria = $request->query();

        if (! $user->isAdmin()) {
            $criteria['user_id'] = $user->id;
        }

        $results = $this->campaignService->getCampaignByCriteria($criteria);

        return new CampaignCollection($results);
    }
}

<?php

namespace App\Http\Controllers\API\LandingPage;

use App\Http\Controllers\Controller;
use App\Http\Resources\LandingPage\LandingPageCollection;
use App\Models\Campaign;
use App\Services\Interfaces\LandingPageServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class LandingPageIndexController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly LandingPageServiceInterface $service
    ) {}

    public function __invoke(Request $request)
    {
        $campaignId = $request->query('campaign_id');

        $landingPages = [];

        if ($campaignId) {
            $campaign = Campaign::findOrFail($campaignId);
            $this->authorize('view', $campaign);

            $landingPages = $this->service->getLandingPageByCriteria(['campaign_id' => $campaignId]);
        }

        return response()->json([
            'success' => true,
            'data' => new LandingPageCollection(collect($landingPages)),
        ], 200);
    }
}

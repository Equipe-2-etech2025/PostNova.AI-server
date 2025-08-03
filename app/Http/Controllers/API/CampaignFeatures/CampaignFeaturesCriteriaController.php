<?php

namespace App\Http\Controllers\API\CampaignFeatures;

use App\Http\Controllers\Controller;
use App\Http\Resources\CampaignFeatures\CampaignFeaturesCollection;
use App\Models\CampaignFeatures;
use App\Services\Interfaces\CampaignFeaturesServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CampaignFeaturesCriteriaController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly CampaignFeaturesServiceInterface $service
    ) {}

    public function __invoke(Request $request)
    {
        $user = Auth::user();
        $this->authorize('viewAny', CampaignFeatures::class);

        $criteria = $request->query();
        if (!$user->isAdmin()) {
            $criteria['user_id'] = $user->id;
        }

        $results = $this->service->getByCriteria($criteria);
        return new CampaignFeaturesCollection($results);
    }
}

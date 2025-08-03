<?php

namespace App\Http\Controllers\API\Features;

use App\Http\Controllers\Controller;
use App\Http\Resources\Feature\FeatureCollection;
use App\Models\Features;
use App\Services\Interfaces\FeaturesServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeaturesCriteriaController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly FeaturesServiceInterface $service
    ) {}

    public function __invoke(Request $request)
    {
        $user = Auth::user();
        $this->authorize('viewAny', Features::class);

        $criteria = $request->query();
        if (!$user->isAdmin()) {
            $criteria['user_id'] = $user->id;
        }

        $results = $this->service->getFeatureByCriteria($criteria);
        return new FeatureCollection($results);
    }
}

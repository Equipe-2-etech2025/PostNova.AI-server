<?php

namespace App\Http\Controllers\API\TarifFeature;

use App\Http\Controllers\Controller;
use App\Http\Resources\TarifFeature\TarifFeatureCollection;
use App\Models\TarifFeature;
use App\Services\Interfaces\TarifFeatureServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TarifFeatureCriteriaController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly TarifFeatureServiceInterface $service
    ) {}

    public function __invoke(Request $request)
    {
        $user = Auth::user();
        $this->authorize('viewAny', TarifFeature::class);

        $criteria = $request->query();
        if (! $user->isAdmin()) {
            $criteria['user_id'] = $user->id;
        }

        $results = $this->service->getTarifFeatureByCriteria($criteria);

        return new TarifFeatureCollection($results);
    }
}

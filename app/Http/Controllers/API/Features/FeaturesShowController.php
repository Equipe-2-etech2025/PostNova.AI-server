<?php

namespace App\Http\Controllers\API\Features;

use App\Http\Controllers\Controller;
use App\Http\Resources\Feature\FeatureResource;
use App\Services\Interfaces\FeaturesServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FeaturesShowController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly FeaturesServiceInterface $service
    ) {}

    public function __invoke(int $id)
    {
        $feature = $this->service->getFeatureById($id);
        $this->authorize('view', $feature);

        return new FeatureResource($feature);
    }
}

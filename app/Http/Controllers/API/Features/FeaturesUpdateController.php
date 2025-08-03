<?php

namespace App\Http\Controllers\API\Features;

use App\Http\Controllers\Controller;
use App\Http\Requests\Feature\UpdateFeatureRequest;
use App\Http\Resources\Feature\FeatureResource;
use App\Models\Features;
use App\Services\Interfaces\FeaturesServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FeaturesUpdateController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly FeaturesServiceInterface $service
    ) {}

    public function __invoke(UpdateFeatureRequest $request, int $id)
    {
        $feature = $this->service->getFeatureById($id);
        $this->authorize('update', $feature);
        $updatedFeature = $this->service->updateFeature($id, $request->toDto($feature));
        return new FeatureResource($updatedFeature);
    }
}

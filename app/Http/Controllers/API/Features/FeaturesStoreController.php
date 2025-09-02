<?php

namespace App\Http\Controllers\API\Features;

use App\Http\Controllers\Controller;
use App\Http\Requests\Feature\CreateFeatureRequest;
use App\Http\Resources\Feature\FeatureResource;
use App\Models\Features;
use App\Services\Interfaces\FeaturesServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FeaturesStoreController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly FeaturesServiceInterface $service
    ) {}

    public function __invoke(CreateFeatureRequest $request)
    {
        $this->authorize('create', Features::class);
        $feature = $this->service->createFeature($request->toDto());

        return new FeatureResource($feature);
    }
}

<?php

namespace App\Http\Controllers\API\Features;

use App\Http\Controllers\Controller;
use App\Http\Resources\Feature\FeatureCollection;
use App\Models\Features;
use App\Services\Interfaces\FeaturesServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FeaturesIndexController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly FeaturesServiceInterface $service
    ) {}

    public function __invoke()
    {
        $this->authorize('viewAny', Features::class);
        $features = $this->service->getAllFeatures();

        return new FeatureCollection($features);
    }
}

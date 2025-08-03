<?php

namespace App\Http\Controllers\API\TarifFeature;

use App\Http\Controllers\Controller;
use App\Http\Requests\TarifFeatures\CreateTarifFeaturesRequest;
use App\Http\Resources\TarifFeature\TarifFeatureResource;
use App\Models\TarifFeature;
use App\Services\Interfaces\TarifFeatureServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TarifFeatureStoreController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly TarifFeatureServiceInterface $service
    ) {}

    public function __invoke(CreateTarifFeaturesRequest $request)
    {
        $this->authorize('create', TarifFeature::class);
        $created = $this->service->createTarifFeature($request->toDto());
        return new TarifFeatureResource($created);
    }
}

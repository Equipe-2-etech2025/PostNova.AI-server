<?php

namespace App\Http\Controllers\API\TarifFeature;

use App\Http\Controllers\Controller;
use App\Http\Requests\TarifFeatures\UpdateTarifFeaturesRequest;
use App\Http\Resources\TarifFeature\TarifFeatureResource;
use App\Services\Interfaces\TarifFeatureServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TarifFeatureUpdateController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly TarifFeatureServiceInterface $service
    ) {}

    public function __invoke(UpdateTarifFeaturesRequest $request, int $id)
    {
        $tarifFeature = $this->service->getTarifFeatureById($id);
        $this->authorize('update', $tarifFeature);
        $updated = $this->service->updateTarifFeature($id, $request->toDto($tarifFeature));

        return new TarifFeatureResource($updated);
    }
}

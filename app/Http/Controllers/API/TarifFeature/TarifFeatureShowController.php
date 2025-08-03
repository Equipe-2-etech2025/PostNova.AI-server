<?php

namespace App\Http\Controllers\API\TarifFeature;

use App\Http\Controllers\Controller;
use App\Http\Resources\TarifFeature\TarifFeatureResource;
use App\Models\TarifFeature;
use App\Services\Interfaces\TarifFeatureServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TarifFeatureShowController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly TarifFeatureServiceInterface $service
    ) {}

    public function __invoke(int $id)
    {
        $tarifFeature = $this->service->getTarifFeatureById($id);
        $this->authorize('view', $tarifFeature);
        return new TarifFeatureResource($tarifFeature);
    }
}

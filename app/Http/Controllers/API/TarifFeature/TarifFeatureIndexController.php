<?php

namespace App\Http\Controllers\API\TarifFeature;

use App\Http\Controllers\Controller;
use App\Http\Resources\TarifFeature\TarifFeatureCollection;
use App\Services\Interfaces\TarifFeatureServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TarifFeatureIndexController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly TarifFeatureServiceInterface $service
    ) {}

    public function __invoke()
    {
        $tarifFeatures = $this->service->getAllTarifFeatures();

        return new TarifFeatureCollection($tarifFeatures);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\FeaturesServiceInterface;
use Illuminate\Http\Request;
use Laravel\Telescope\AuthorizesRequests;

class FeaturesController extends Controller
{
    use AuthorizesRequests;

    private FeaturesServiceInterface $featuresService;

    public function __construct(FeaturesServiceInterface $featuresService)
    {
        $this->featuresService = $featuresService;
    }

    public function index()
    {
        return $this->featuresService->getAllFeatures();
    }

    public function show(int $id)
    {
        return $this->featuresService->getFeatureById($id);
    }

    public function store(Request $request)
    {
        return $this->featuresService->createFeature($request->all());
    }

    public function update(Request $request, int $id)
    {
        return $this->featuresService->updateFeature($id, $request->all());
    }

    public function destroy(int $id)
    {
        return $this->featuresService->deleteFeature($id);
    }

    public function showByCriteria(Request $request)
    {
        return $this->featuresService->getFeatureByCriteria($request->all());
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Feature\CreateFeatureRequest;
use App\Http\Requests\Feature\UpdateFeatureRequest;
use App\Http\Resources\Feature\FeatureCollection;
use App\Http\Resources\Feature\FeatureResource;
use App\Services\Interfaces\FeaturesServiceInterface;
use Illuminate\Http\Request;
use Laravel\Telescope\AuthorizesRequests;
use App\Models\Features;

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
        $this->authorize('viewAny', Features::class);
        $features = $this->featuresService->getAllFeatures();
        return new FeatureCollection($features);
    }

    public function show(int $id)
    {
        $features = $this->featuresService->getFeatureById($id);
        $this->authorize('view', $features);
        return new FeatureResource($features);
    }

    public function store(CreateFeatureRequest $request)
    {
        $data = $request->validated();
        $this->authorize('create', Features::class);
        $features = $this->featuresService->createFeature($data);
        return  new FeatureResource($features);
    }

    public function update(UpdateFeatureRequest $request, int $id)
    {
        $data = $request->validated();
        $features = $this->featuresService->getFeatureById($id);
        $this->authorize('update', $features);
        $features = $this->featuresService->updateFeature($id, $data);
        return  new FeatureResource($features);
    }

    public function destroy(int $id)
    {
        $features = $this->featuresService->getFeatureById($id);
        $this->authorize('delete', $features);
        $this->featuresService->deleteFeature($id);

        return response()->json(['message' => 'Supprimé avec succès.'], 200);
    }

    public function showByCriteria(Request $request)
    {
        $feature = $this->featuresService->getFeatureByCriteria($request->query());
        return new FeatureCollection($feature);
    }
}

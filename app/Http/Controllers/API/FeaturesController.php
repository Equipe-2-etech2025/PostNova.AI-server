<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Feature\CreateFeatureRequest;
use App\Http\Requests\Feature\UpdateFeatureRequest;
use App\Http\Resources\Feature\FeatureCollection;
use App\Http\Resources\Feature\FeatureResource;
use App\Services\Interfaces\FeaturesServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $this->authorize('create', Features::class);
        $featureDto = $request->toDto();
        $feature = $this->featuresService->createFeature($featureDto);
        return new FeatureResource($feature);
    }

    public function update(UpdateFeatureRequest $request, int $id)
    {
        $feature = $this->featuresService->getFeatureById($id);
        $this->authorize('update', $feature);
        $featureDto = $request->toDto($feature);
        $updatedFeature = $this->featuresService->updateFeature($id, $featureDto);
        return new FeatureResource($updatedFeature);
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
        $user = Auth::user();
        $this->authorize('viewAny', Feature::class);

        $criteria = $request->query();
        if (!$user->isAdmin()) {
            $criteria['user_id'] = $user->id;
        }

        $results = $this->featuresService->getFeatureByCriteria($criteria);

        return new FeatureCollection($results);
    }

}

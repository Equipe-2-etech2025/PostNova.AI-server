<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TarifFeatures\CreateTarifFeaturesRequest;
use App\Http\Requests\TarifFeatures\UpdateTarifFeaturesRequest;
use App\Http\Resources\TarifFeature\TarifFeatureCollection;
use App\Http\Resources\TarifFeature\TarifFeatureResource;
use App\Services\Interfaces\TarifFeatureServiceInterface;
use Illuminate\Http\Request;
use Laravel\Telescope\AuthorizesRequests;
use App\Models\TarifFeature;

class TarifFeatureController extends Controller
{
    use AuthorizesRequests;

    private TarifFeatureServiceInterface $tarifFeatureService;

    public function __construct(TarifFeatureServiceInterface $tarifFeatureService)
    {
        $this->tarifFeatureService = $tarifFeatureService;
    }

    public function index()
    {
        $tarifFeatures = $this->tarifFeatureService->getAllTarifFeatures();
        return new TarifFeatureCollection($tarifFeatures);
    }

    public function show(int $id)
    {
        $tarifFeature = $this->tarifFeatureService->getTarifFeatureById($id);
        $this->authorize('view', $tarifFeature);
        return new TarifFeatureResource($tarifFeature);
    }

    public function store(CreateTarifFeaturesRequest $request)
    {
        $this->authorize('create', TarifFeature::class);
        $created = $this->tarifFeatureService->createTarifFeature($request->validated());
        return new TarifFeatureResource($created);
    }

    public function update(UpdateTarifFeaturesRequest $request, int $id)
    {
        $tarifFeature = $this->tarifFeatureService->getTarifFeatureById($id);
        $this->authorize('update', $tarifFeature);
        $updated = $this->tarifFeatureService->updateTarifFeature($id, $request->validated());
        return new TarifFeatureResource($updated);
    }

    public function destroy(int $id)
    {
        $tarifFeature = $this->tarifFeatureService->getTarifFeatureById($id);
        $this->authorize('delete', $tarifFeature);
        $this->tarifFeatureService->deleteTarifFeature($id);

        return response()->json(['message' => 'Supprimé avec succès.'], 200);
    }

    public function showByCriteria(Request $request)
    {
        $results = $this->tarifFeatureService->getTarifFeatureByCriteria($request->query());
        return new TarifFeatureCollection($results);
    }
}


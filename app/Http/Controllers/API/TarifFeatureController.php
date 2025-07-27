<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\TarifFeatureServiceInterface;
use Illuminate\Http\Request;
use Laravel\Telescope\AuthorizesRequests;

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
        return $this->tarifFeatureService->getAllTarifFeatures();
    }

    public function show(int $id)
    {
        return $this->tarifFeatureService->getTarifFeatureById($id);
    }

    public function store(Request $request)
    {
        return $this->tarifFeatureService->createTarifFeature($request->all());
    }

    public function update(Request $request, int $id)
    {
        return $this->tarifFeatureService->updateTarifFeature($id, $request->all());
    }

    public function destroy(int $id)
    {
        return $this->tarifFeatureService->deleteTarifFeature($id);
    }

    public function showByCriteria(Request $request)
    {
        return $this->tarifFeatureService->getTarifFeatureByCriteria($request->query());
    }
}

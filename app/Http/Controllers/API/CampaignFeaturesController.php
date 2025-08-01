<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CampaignFeatures\CampaignFeaturesCollection;
use App\Services\Interfaces\CampaignFeaturesServiceInterface;
use Illuminate\Http\Request;
use App\Http\Requests\CampaignFeatures\CreateCampaignFeaturesRequest;
use App\Http\Requests\CampaignFeatures\UpdateCampaignFeaturesRequest;
use App\Http\Resources\CampaignFeatures\CampaignFeaturesResource;
use App\Models\CampaignFeatures;

class CampaignFeaturesController extends Controller
{
    private CampaignFeaturesServiceInterface $campaignFeaturesService;

    public function __construct(CampaignFeaturesServiceInterface $campaignFeaturesService)
    {
        $this->campaignFeaturesService = $campaignFeaturesService;
    }

    public function index()
    {
        $this->authorize('viewAny', CampaignFeatures::class);
        $campaignFeature = $this->campaignFeaturesService->getAll();
        return new CampaignFeaturesCollection($campaignFeature);
    }

    public function show(int $id)
    {
        $campaignFeature = $this->campaignFeaturesService->getById($id);
        $this->authorize('view', $campaignFeature);
        return new CampaignFeaturesResource($campaignFeature);
    }

    public function store(CreateCampaignFeaturesRequest $request)
    {
        $data = $request->validated();
        $created = $this->campaignFeaturesService->create($data);
        return new CampaignFeaturesResource($created);
    }

    public function update(UpdateCampaignFeaturesRequest $request, int $id)
    {
        $campaignFeature = $this->campaignFeaturesService->getById($id);
        $this->authorize('update', $campaignFeature);
        $updated = $this->campaignFeaturesService->update($id, $request->validated());
        return new CampaignFeaturesResource($updated);
    }

    public function destroy(int $id)
    {
        $campaignFeature = $this->campaignFeaturesService->getById($id);
        $this->authorize('delete', $campaignFeature);
        $this->campaignFeaturesService->delete($id);

        return response()->json(['message' => 'Supprimé avec succès.'], 200);
    }

    public function showByCriteria(Request $request)
    {
        $criteria = $request->query();
        $features = $this->campaignFeaturesService->getByCriteria($criteria);
        return new CampaignFeaturesCollection($features);
    }
}

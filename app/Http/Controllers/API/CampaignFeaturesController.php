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
use Illuminate\Support\Facades\Auth;

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
        $this->authorize('create', CampaignFeatures::class); // ← ajout cohérent si tu as une policy
        $dto = $request->toDto();
        $created = $this->campaignFeaturesService->create($dto);
        return new CampaignFeaturesResource($created);
    }

    public function update(UpdateCampaignFeaturesRequest $request, int $id)
    {
        $campaignFeature = $this->campaignFeaturesService->getById($id);
        $this->authorize('update', $campaignFeature);
        $dto = $request->toDto($campaignFeature); // ← si tu utilises l’existant dans ton dto
        $updated = $this->campaignFeaturesService->update($id, $dto);
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
        $user = Auth::user();
        $this->authorize('viewAny', CampaignFeatures::class);

        $criteria = $request->query();
        if (!$user->isAdmin()) {
            $criteria['user_id'] = $user->id;
        }

        $results = $this->campaignFeaturesService->getByCriteria($criteria);

        return new CampaignFeaturesCollection($results);
    }

}

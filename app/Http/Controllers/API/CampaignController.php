<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Campaign\CreateCampaignRequest;
use App\Http\Requests\Campaign\UpdateCampaignRequest;
use App\Http\Resources\Campaign\CampaignCollection;
use App\Http\Resources\Campaign\CampaignResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\CampaignServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Models\Campaign;

class CampaignController extends Controller
{
    use AuthorizesRequests;

    private CampaignServiceInterface $campaignService;

    public function __construct(CampaignServiceInterface $campaignService)
    {
        $this->campaignService = $campaignService;
    }

    public function index()
    {
        $user = Auth::user();

        $this->authorize('viewAny', Campaign::class);

        if ($user->hasRole('admin')) {
            $campaigns = $this->campaignService->getAllCampaigns();
        } else {
            $campaigns = $this->campaignService->getCampaignsByUserId($user->id);
        }

        return new CampaignCollection($campaigns);
    }

    public function show(int $id)
    {
        $campaign = $this->campaignService->getCampaignById($id);
        $this->authorize('view', $campaign);
        return new CampaignResource($campaign);
    }

    public function store(CreateCampaignRequest $request)
    {
        $this->authorize('create', Campaign::class);
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $campaign = $this->campaignService->createCampaign($data);
        return new CampaignResource($campaign);
    }

    public function update(UpdateCampaignRequest $request, int $id)
    {
        $campaign = $this->campaignService->getCampaignById($id);
        $this->authorize('update', $campaign);
        $data = $request->validated();
        $updatedCampaign = $this->campaignService->updateCampaign($id, $data);
        return new CampaignResource($updatedCampaign);
    }

    public function destroy(int $id)
    {
        $campaign = $this->campaignService->getCampaignById($id);
        $this->authorize('delete', $campaign);
        $this->campaignService->deleteCampaign($id);

        return response()->json(['message' => 'Supprimé avec succès.'], 200);
    }

    public function showByCriteria(Request $request)
    {
        $criteria = $request->query();
        $campaigns = $this->campaignService->getCampaignByCriteria($criteria);
        return new CampaignCollection($campaigns);
    }

    public function showByUserId(int $id)
    {
        $campaigns = $this->campaignService->getCampaignsByUserId($id);
        return response()->json($campaigns);
    }
}

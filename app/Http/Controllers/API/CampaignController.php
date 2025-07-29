<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\CampaignServiceInterface;
use Illuminate\Http\Request;
use Laravel\Telescope\AuthorizesRequests;

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
        return $this->campaignService->getAllCampaigns();
    }

    public function show(int $id)
    {
        return $this->campaignService->getCampaignById($id);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::id();
        return $this->campaignService->createCampaign($data);
    }

    public function update(Request $request, int $id)
    {
        $data = $request->all();
        return $this->campaignService->updateCampaign($id, $data);
    }

    public function destroy(int $id)
    {
        return $this->campaignService->deleteCampaign($id);
    }

    public function showByCriteria(Request $request)
    {
        $criteria = $request->query();
        $campaign = $this->campaignService->getCampaignByCriteria($criteria);
        return response()->json($campaign);
    }

    public function showByUserId(int $id)
    {
        $campaign = $this->campaignService->getCampaignsByUserId($id);
        return response()->json($campaign);
    }

}

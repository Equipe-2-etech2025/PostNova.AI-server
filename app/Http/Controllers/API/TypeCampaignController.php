<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\TypeCampaignServiceInterface;
use Illuminate\Http\Request;
use Laravel\Telescope\AuthorizesRequests;

class TypeCampaignController extends Controller
{
    use AuthorizesRequests;

    private TypeCampaignServiceInterface $typeCampaignService;

    public function __construct(TypeCampaignServiceInterface $typeCampaignService)
    {
        $this->typeCampaignService = $typeCampaignService;
    }

    public function index()
    {
        return $this->typeCampaignService->getAllTypeCampaign();
    }

    public function show(int $id)
    {
        return $this->typeCampaignService->getTypeCampaignById($id);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        return $this->typeCampaignService->createTypeCampaign($data);
    }

    public function update(Request $request, int $id)
    {
        $data = $request->all();
        return $this->typeCampaignService->updateTypeCampaign($id, $data);
    }

    public function destroy(int $id)
    {
        return $this->typeCampaignService->deleteTypeCampaign($id);
    }

    public function showByCriteria(Request $request)
    {
        return $this->typeCampaignService->getTypeCampaignByCriteria($request->query());
    }
}

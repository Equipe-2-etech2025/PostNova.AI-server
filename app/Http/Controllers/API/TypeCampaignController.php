<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TypeCampaign\CreateTypeCampaignRequest;
use App\Http\Requests\TypeCampaign\UpdateTypeCampaignRequest;
use App\Http\Resources\Campaign\CampaignResource;
use App\Http\Resources\TypeCampaign\TypeCampaignResource;
use App\Models\TypeCampaign;
use App\Services\Interfaces\TypeCampaignServiceInterface;
use http\Client\Curl\User;
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
        $this->authorize('viewAny', TypeCampaign::class);
        $typeCampaign = $this->typeCampaignService->getAllTypeCampaign();

        return  TypeCampaignResource::collection($typeCampaign);
    }

    public function show(int $id)
    {
        $this->authorize('view', $this->typeCampaignService->getTypeCampaignById($id));
        $typeCampaign = $this->typeCampaignService->getTypeCampaignById($id);
        return new TypeCampaignResource($typeCampaign);
    }

    public function store(CreateTypeCampaignRequest $request)
    {
        $data = $request->validated();
        $this->authorize('create', TypeCampaign::class);
        $typeCampaign = $this->typeCampaignService->createTypeCampaign($data);
        return new TypeCampaignResource($typeCampaign);
    }

    public function update( UpdateTypeCampaignRequest $request, int $id)
    {
        $data = $request->validated();
        $typeCampaign = $this->typeCampaignService->getTypeCampaignById($id);
        $this->authorize('update', $typeCampaign);
        $typeCampaign = $this->typeCampaignService->updateTypeCampaign($id, $data);
        return  new TypeCampaignResource($typeCampaign);
    }

    public function destroy(int $id)
    {
        $typeCampaign = $this->typeCampaignService->getTypeCampaignById($id);
        $this->authorize('delete', $typeCampaign);
        $this->typeCampaignService->deleteTypeCampaign($id);

        return response()->json(['message' => 'Supprimé avec succès.'], 200);
    }

    public function showByCriteria(Request $request)
    {
        $typeCampaign = $this->typeCampaignService->getTypeCampaignByCriteria($request->query());
        return new TypeCampaignCollection($typeCampaign);
    }
}

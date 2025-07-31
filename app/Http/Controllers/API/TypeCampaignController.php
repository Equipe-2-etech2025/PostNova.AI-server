<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TypeCampaign\CreateTypeCampaignRequest;
use App\Http\Requests\TypeCampaign\UpdateTypeCampaignRequest;
use App\Http\Resources\TypeCampaign\TypeCampaignCollection;
use App\Http\Resources\TypeCampaign\TypeCampaignResource;
use App\Models\TypeCampaign;
use App\Services\Interfaces\TypeCampaignServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $this->authorize('create', TypeCampaign::class);
        $typeCampaignDto = $request->toDto();
        $typeCampaign = $this->typeCampaignService->createTypeCampaign($typeCampaignDto);

        return new TypeCampaignResource($typeCampaign);
    }

    public function update(UpdateTypeCampaignRequest $request, int $id)
    {
        $typeCampaign = $this->typeCampaignService->getTypeCampaignById($id);
        $this->authorize('update', $typeCampaign);
        $typeCampaignDto = $request->toDto($typeCampaign);
        $updatedTypeCampaign = $this->typeCampaignService->updateTypeCampaign($id, $typeCampaignDto);

        return new TypeCampaignResource($updatedTypeCampaign);
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
        $user = Auth::user();
        $this->authorize('viewAny', TypeCampaign::class);

        $criteria = $request->query();
        if (!$user->isAdmin()) {
            $criteria['user_id'] = $user->id;
        }

        $results = $this->typeCampaignService->getTypeCampaignByCriteria($criteria);

        return new TypeCampaignCollection($results);
    }

}

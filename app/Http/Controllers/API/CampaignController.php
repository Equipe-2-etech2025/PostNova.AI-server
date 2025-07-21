<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Campaign\CreateCampaignRequest;
use App\Http\Requests\Campaign\UpdateCampaignRequest;
use App\Http\Resources\Campaign\CampaignResource;
use App\Http\Resources\Campaign\CampaignCollection;
use App\Services\Interfaces\CampaignServiceInterface;
use Illuminate\Http\JsonResponse;

class CampaignController extends Controller
{
    public function __construct(private CampaignServiceInterface $service)
    {
        $this->middleware('auth:api');
    }

    public function index(): JsonResponse
    {
        $campaigns = $this->service->getAllCampaigns();
        return response()->json(new CampaignCollection($campaigns));
    }

    public function show(int $id): JsonResponse
    {
        $campaign = $this->service->getCampaignById($id);
        return response()->json(new CampaignResource($campaign));
    }

    public function store(CreateCampaignRequest $request): JsonResponse
    {
        $campaign = $this->service->createCampaign($request->validated());
        return response()->json(new CampaignResource($campaign), 201);
    }

    public function update(UpdateCampaignRequest $request, int $id): JsonResponse
    {
        $campaign = $this->service->updateCampaign($id, $request->validated());
        return response()->json(new CampaignResource($campaign));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->deleteCampaign($id);
        return response()->json(null, 204);
    }

    public function byUser(int $userId): JsonResponse
    {
        $campaigns = $this->service->getCampaignsByUser($userId);
        return response()->json(new CampaignCollection($campaigns));
    }

    public function byType(int $typeId): JsonResponse
    {
        $campaigns = $this->service->getCampaignsByType($typeId);
        return response()->json(new CampaignCollection($campaigns));
    }
}

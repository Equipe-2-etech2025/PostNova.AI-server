<?php

namespace App\Http\Controllers\API\Campaign;

use App\Http\Controllers\Controller;
use App\Http\Resources\Campaign\CampaignCollection;
use App\Services\Interfaces\CampaignServiceInterface;
use Illuminate\Http\JsonResponse;

class CampaignUserController extends Controller
{
    public function __construct(
        private readonly CampaignServiceInterface $campaignService
    ) {}

    public function __invoke(int $userId): JsonResponse
    {
        $campaigns = $this->campaignService->getCampaignsByUserId($userId);

        return response()->json(
            new CampaignCollection($campaigns)
        );
    }
}

<?php

namespace App\Http\Controllers\API\v2\Campaign;

use App\Http\Controllers\Controller;
use App\Http\Requests\Campaign\CreateCampaignRequest;
use App\Http\Resources\Campaign\CampaignResource;
use App\Services\v2\Campaign\CampaignGenerateService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class CampaignGenerateController extends Controller
{
    public function __construct(
        private readonly CampaignGenerateService $campaignGenerateService
    ) {}

    public function __invoke(CreateCampaignRequest $request)
    {
        $validated = $request->toDto();
        $campaign = $this->campaignGenerateService->generateCampaign($validated);
        return $this->success(
            new CampaignResource($campaign),
            Response::HTTP_CREATED
        );
    }
}

<?php

namespace App\Http\Controllers\API\CampaignInteraction;

use App\Http\Controllers\Controller;
use App\Http\Requests\CampaignInteraction\CreateCampaignInteractionRequest;
use App\Http\Resources\CampaignInteraction\CampaignInteractionResource;
use App\Models\CampaignInteraction;
use App\Services\Interfaces\CampaignInteractionServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CampaignInteractionStoreController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private CampaignInteractionServiceInterface $service
    ) {}

    public function __invoke(CreateCampaignInteractionRequest $request)
    {
        $dto = $request->toDto();
        $this->authorize('create', CampaignInteraction::class);

        $interaction = $this->service->createInteraction($dto);

        return new CampaignInteractionResource($interaction);
    }
}

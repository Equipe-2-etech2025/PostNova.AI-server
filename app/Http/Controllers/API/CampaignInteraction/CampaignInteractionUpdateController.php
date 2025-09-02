<?php

namespace App\Http\Controllers\API\CampaignInteraction;

use App\Http\Controllers\Controller;
use App\Http\Requests\CampaignInteraction\UpdateCampaignInteractionRequest;
use App\Http\Resources\CampaignInteraction\CampaignInteractionResource;
use App\Services\Interfaces\CampaignInteractionServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CampaignInteractionUpdateController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private CampaignInteractionServiceInterface $service
    ) {}

    public function __invoke(UpdateCampaignInteractionRequest $request, int $id)
    {
        $interaction = $this->service->getInteractionById($id);
        $this->authorize('update', $interaction);

        $dto = $request->toDto();
        $updated = $this->service->updateInteraction($id, $dto);

        return new CampaignInteractionResource($updated);
    }
}

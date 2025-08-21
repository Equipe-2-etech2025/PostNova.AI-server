<?php

namespace App\Http\Controllers\API\CampaignInteraction;

use App\DTOs\CampaignInteraction\CampaignInteractionDto;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\CampaignInteractionServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class CampaignInteractionLikeController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private CampaignInteractionServiceInterface $service
    ) {}

    public function __invoke(Request $request, int $interactionId)
    {
        $interaction = $this->service->getInteractionById($interactionId);
        $this->authorize('like', $interaction);

        $this->service->updateInteraction(
            $interactionId,
            CampaignInteractionDto::fromArray(['likes' => $interaction->likes + 1])
        );


        return response()->json(['message' => 'Like ajouté avec succès']);
    }
}

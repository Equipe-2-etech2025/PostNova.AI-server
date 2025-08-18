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

        // Valeur actuelle des likes (0 si null)
        $currentLikes = $interaction->likes ?? 0;

        // Création du DTO avec likes incrémentés
        $dto = new CampaignInteractionDto(
            id: $interaction->id,
            user_id: $interaction->user_id,
            campaign_id: $interaction->campaign_id,
            views: $interaction->views,
            likes: $currentLikes + 1,
            shares: $interaction->shares
        );

        $this->service->updateInteraction($interactionId, $dto);

        return response()->json(['message' => 'Like ajouté avec succès']);
    }
}

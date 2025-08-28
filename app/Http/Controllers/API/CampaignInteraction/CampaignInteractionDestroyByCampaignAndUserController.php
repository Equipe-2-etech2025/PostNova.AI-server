<?php

namespace App\Http\Controllers\API\CampaignInteraction;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\CampaignInteractionServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class CampaignInteractionDestroyByCampaignAndUserController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private CampaignInteractionServiceInterface $service
    ) {}

    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'campaign_id' => 'required|integer|exists:campaigns,id',
            'user_id' => 'required|integer|exists:users,id',
        ]);

        $deleted = $this->service->deleteInteractionByCampaignAndUser(
            $validated['campaign_id'],
            $validated['user_id']
        );

        if ($deleted) {
            return response()->json(['message' => 'Interaction supprimée avec succès'], 200);
        }

        return response()->json(['message' => 'Aucune interaction trouvée pour ce couple campaign_id / user_id'], 404);
    }
}

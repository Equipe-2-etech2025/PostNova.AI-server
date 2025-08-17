<?php

namespace App\Http\Controllers\API\CampaignInteraction;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\CampaignInteractionServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CampaignInteractionDestroyController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private CampaignInteractionServiceInterface $service
    ) {}

    public function __invoke(int $id)
    {
        $interaction = $this->service->getInteractionById($id);
        $this->authorize('delete', $interaction);

        $this->service->deleteInteraction($id);

        return response()->json(['message' => 'Interaction supprimée avec succès'], 200);
    }
}

<?php

namespace App\Http\Controllers\API\CampaignTemplate;

use App\Http\Controllers\Controller;
use App\Http\Resources\CampaignTemplate\CampaignTemplateResource;
use App\Services\Interfaces\CampaignTemplateServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

class CampaignTemplateShowController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly CampaignTemplateServiceInterface $service
    ) {}

    /**
     * Retourne un modèle de campagne spécifique avec stats (rating, uses)
     */
    public function __invoke(int $id): JsonResponse|CampaignTemplateResource
    {
        $template = $this->service->getTemplateById($id);

        return new CampaignTemplateResource($template);
    }
}

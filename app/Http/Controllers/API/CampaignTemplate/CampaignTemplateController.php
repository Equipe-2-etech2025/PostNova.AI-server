<?php

namespace App\Http\Controllers\API\CampaignTemplate;

use App\Http\Controllers\Controller;
use App\Http\Resources\CampaignTemplate\CampaignTemplateResource;
use App\Services\Interfaces\CampaignTemplateServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CampaignTemplateController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly CampaignTemplateServiceInterface $service
    ) {}

    /**
     * Retourne la liste des modèles de campagnes avec stats (rating, uses)
     */
    public function __invoke()
    {
        $templates = $this->service->getAllTemplatesWithStats();

        return CampaignTemplateResource::collection($templates);
    }
}

<?php

namespace App\Http\Controllers\API\TypeCampaign;

use App\Http\Controllers\Controller;
use App\Http\Resources\TypeCampaign\TypeCampaignResource;
use App\Services\Interfaces\TypeCampaignServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TypeCampaignShowController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private TypeCampaignServiceInterface $service
    ) {}

    public function __invoke(int $id)
    {
        $typeCampaign = $this->service->getTypeCampaignById($id);
        $this->authorize('view', $typeCampaign);

        return new TypeCampaignResource($typeCampaign);
    }
}

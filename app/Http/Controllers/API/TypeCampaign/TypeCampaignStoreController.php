<?php

namespace App\Http\Controllers\API\TypeCampaign;

use App\Http\Controllers\Controller;
use App\Http\Requests\TypeCampaign\CreateTypeCampaignRequest;
use App\Http\Resources\TypeCampaign\TypeCampaignResource;
use App\Services\Interfaces\TypeCampaignServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TypeCampaignStoreController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private TypeCampaignServiceInterface $service
    ) {}

    public function __invoke(CreateTypeCampaignRequest $request)
    {
        $typeCampaign = $this->service->createTypeCampaign($request->toDto());
        $this->authorize('create', $typeCampaign);

        return new TypeCampaignResource($typeCampaign);
    }
}

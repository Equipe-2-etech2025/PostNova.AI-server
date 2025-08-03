<?php
namespace App\Http\Controllers\API\TypeCampaign;

use App\Http\Controllers\Controller;
use App\Http\Requests\TypeCampaign\CreateTypeCampaignRequest;
use App\Http\Resources\TypeCampaign\TypeCampaignResource;
use App\Models\TypeCampaign;
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
        $this->authorize('create', TypeCampaign::class);
        return new TypeCampaignResource(
            $this->service->createTypeCampaign($request->toDto())
        );
    }
}

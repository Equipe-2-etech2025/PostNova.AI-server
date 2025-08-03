<?php
namespace App\Http\Controllers\API\TypeCampaign;

use App\Http\Controllers\Controller;
use App\Http\Requests\TypeCampaign\UpdateTypeCampaignRequest;
use App\Http\Resources\TypeCampaign\TypeCampaignResource;
use App\Models\TypeCampaign;
use App\Services\Interfaces\TypeCampaignServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TypeCampaignUpdateController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private TypeCampaignServiceInterface $service
    ) {}

    public function __invoke(UpdateTypeCampaignRequest $request, int $id)
    {
        $typeCampaign = $this->service->getTypeCampaignById($id);
        $this->authorize('update', $typeCampaign);
        return new TypeCampaignResource(
            $this->service->updateTypeCampaign($id, $request->toDto($typeCampaign))
        );
    }
}

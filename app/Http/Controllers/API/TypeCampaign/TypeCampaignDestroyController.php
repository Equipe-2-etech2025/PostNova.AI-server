<?php
namespace App\Http\Controllers\API\TypeCampaign;

use App\Http\Controllers\Controller;
use App\Models\TypeCampaign;
use App\Services\Interfaces\TypeCampaignServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

class TypeCampaignDestroyController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private TypeCampaignServiceInterface $service
    ) {}

    public function __invoke(int $id): JsonResponse
    {
        $typeCampaign = $this->service->getTypeCampaignById($id);
        $this->authorize('delete', $typeCampaign);
        $this->service->deleteTypeCampaign($id);
        return response()->json(['message' => 'Supprimé avec succès.'], 200);
    }
}

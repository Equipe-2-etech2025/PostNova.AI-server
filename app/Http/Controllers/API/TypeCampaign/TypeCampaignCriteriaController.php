<?php

namespace App\Http\Controllers\API\TypeCampaign;

use App\Http\Controllers\Controller;
use App\Http\Resources\TypeCampaign\TypeCampaignCollection;
use App\Models\TypeCampaign;
use App\Services\Interfaces\TypeCampaignServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TypeCampaignCriteriaController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private TypeCampaignServiceInterface $service
    ) {}

    public function __invoke(Request $request)
    {
        $user = Auth::user();
        $this->authorize('viewAny', TypeCampaign::class);

        $criteria = $request->query();
        if (! $user->isAdmin()) {
            $criteria['user_id'] = $user->id;
        }

        return new TypeCampaignCollection(
            $this->service->getTypeCampaignByCriteria($criteria)
        );
    }
}

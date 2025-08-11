<?php

namespace App\Http\Controllers\API\TypeCampaign;

use App\Http\Controllers\Controller;
use App\Http\Resources\TypeCampaign\TypeCampaignCollection;
use App\Models\TypeCampaign;
use App\Services\Interfaces\TypeCampaignServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TypeCampaignIndexController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private TypeCampaignServiceInterface $service
    ) {}

    public function __invoke()
    {
        $this->authorize('viewAny', TypeCampaign::class);

        return new TypeCampaignCollection($this->service->getAllTypeCampaign());
    }
}

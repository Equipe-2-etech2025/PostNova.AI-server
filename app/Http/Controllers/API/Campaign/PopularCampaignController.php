<?php

namespace App\Http\Controllers\API\Campaign;

use App\Http\Controllers\Controller;
use App\Http\Resources\Campaign\PopularCampaignResource;
use App\Services\Interfaces\ContentServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PopularCampaignController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly ContentServiceInterface $service
    ) {}

    public function __invoke()
    {
        $data = $this->service->getTopCampaignsWithStats();

        return PopularCampaignResource::collection($data['campaigns'])
            ->additional([
                'totals' => $data['totals'],
            ]);
    }
}

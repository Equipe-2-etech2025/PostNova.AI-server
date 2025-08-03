<?php

namespace App\Http\Controllers\API\LandingPage;

use App\Http\Controllers\Controller;
use App\Http\Requests\LandingPage\CreateLandingPageRequest;
use App\Http\Resources\LandingPage\LandingPageResource;
use App\Models\LandingPage;
use App\Services\Interfaces\LandingPageServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class LandingPageStoreController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly LandingPageServiceInterface $service
    ) {}

    public function __invoke(CreateLandingPageRequest $request)
    {
        $landingPageDto = $request->toDto();
        $this->authorize('create', [LandingPage::class, $landingPageDto->campaign_id]);
        $landingPage = $this->service->createLandingPage($landingPageDto);
        return new LandingPageResource($landingPage);
    }
}

<?php

namespace App\Http\Controllers\API\LandingPage;

use App\Http\Controllers\Controller;
use App\Http\Requests\LandingPage\UpdateLandingPageRequest;
use App\Http\Resources\LandingPage\LandingPageResource;
use App\Services\Interfaces\LandingPageServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class LandingPageUpdateController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly LandingPageServiceInterface $service
    ) {}

    public function __invoke(UpdateLandingPageRequest $request, int $id)
    {
        $landingPage = $this->service->getLandingPageById($id);
        $this->authorize('update', $landingPage);
        $updatedLandingPage = $this->service->updateLandingPage($id, $request->toDto($landingPage));

        return new LandingPageResource($updatedLandingPage);
    }
}

<?php

namespace App\Http\Controllers\API\LandingPage;

use App\Http\Controllers\Controller;
use App\Http\Resources\LandingPage\LandingPageResource;
use App\Models\LandingPage;
use App\Services\Interfaces\LandingPageServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class LandingPageShowController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly LandingPageServiceInterface $service
    ) {}

    public function __invoke(int $id)
    {
        $landingPage = $this->service->getLandingPageById($id);
        $this->authorize('view', $landingPage);
        return new LandingPageResource($landingPage);
    }
}

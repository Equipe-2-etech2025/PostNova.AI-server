<?php

namespace App\Http\Controllers\API\v2\LandingPage;

use App\Http\Controllers\Controller;
use App\Models\LandingPage;
use App\Services\Interfaces\LandingPageServiceInterface;
use Illuminate\Http\Response;

class LandingPageDestroyController extends Controller
{
    public function __construct(
        private readonly LandingPageServiceInterface $service
    ) {}

    public function __invoke(LandingPage $landingPage)
    {
        $this->authorize('delete', $landingPage);
        $this->service->deleteLandingPage($landingPage->id);
        $this->success(
            [],
            Response::HTTP_NO_CONTENT
        );
    }
}

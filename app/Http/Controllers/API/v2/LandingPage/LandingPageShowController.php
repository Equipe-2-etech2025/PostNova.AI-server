<?php

namespace App\Http\Controllers\API\v2\LandingPage;

use App\Http\Controllers\Controller;
use App\Http\Resources\LandingPage\LandingPageResource;
use App\Models\LandingPage;
use App\Traits\ApiResponse;

class LandingPageShowController extends Controller
{
    public function __invoke(LandingPage $landingPage)
    {
        $this->authorize('view', $landingPage);
        return $this->success(
            new LandingPageResource($landingPage)
        );
    }
}
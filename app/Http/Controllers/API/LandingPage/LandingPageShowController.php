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

    public function __invoke(LandingPage $landingPage)
    {
        try {
            $this->authorize('viewAny', $landingPage);

            return response()->json([
                'success' => true,
                'data' => new LandingPageResource($landingPage)
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}

<?php

namespace App\Http\Controllers\API\LandingPage;

use App\Http\Controllers\Controller;
use App\Http\Resources\LandingPage\LandingPageResource;
use App\Services\Interfaces\LandingPageServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class LandingPageUpdateController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly LandingPageServiceInterface $service
    ) {}

    public function __invoke(Request $request, int $id)
    {
       try {
            $request->validate([
                'content' => 'required|array',
            ]);

            $updatedLandingPage = $this->service->updateLandingPage($id, $request->only('content'));

            return response()->json([
                'success' => true,
                'message' => 'Landing page mise à jour avec succès',
                'data' => $updatedLandingPage,
            ], 200);
       } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
       }
    }
}

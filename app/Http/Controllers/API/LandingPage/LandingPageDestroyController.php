<?php

namespace App\Http\Controllers\API\LandingPage;

use App\Http\Controllers\Controller;
use App\Models\LandingPage;
use App\Services\Interfaces\LandingPageServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

class LandingPageDestroyController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly LandingPageServiceInterface $service
    ) {}

    public function __invoke(int $id): JsonResponse
    {
        $landingPage = $this->service->getLandingPageById($id);
        $this->authorize('delete', $landingPage);
        $this->service->deleteLandingPage($id);
        return response()->json(['message' => 'Supprimé avec succès.'], 200);
    }
}

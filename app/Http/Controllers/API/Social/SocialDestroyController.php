<?php

namespace App\Http\Controllers\API\Social;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\SocialServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

class SocialDestroyController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly SocialServiceInterface $service
    ) {}

    public function __invoke(int $id): JsonResponse
    {
        $social = $this->service->getSocialById($id);
        $this->authorize('delete', $social);
        $this->service->deleteSocial($id);

        return response()->json(['message' => 'Supprimé avec succès.'], 200);
    }
}

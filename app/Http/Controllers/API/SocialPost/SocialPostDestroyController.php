<?php

namespace App\Http\Controllers\API\SocialPost;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\SocialPostServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

class SocialPostDestroyController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly SocialPostServiceInterface $service
    ) {}

    public function __invoke(int $id): JsonResponse
    {
        $socialPost = $this->service->getSocialPostById($id);
        $this->authorize('delete', $socialPost);
        $this->service->deleteSocialPost($id);

        return response()->json(['message' => 'Supprimé avec succès.'], 200);
    }
}

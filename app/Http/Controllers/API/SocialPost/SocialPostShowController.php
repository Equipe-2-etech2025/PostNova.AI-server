<?php

namespace App\Http\Controllers\API\SocialPost;

use App\Http\Controllers\Controller;
use App\Http\Resources\SocialPost\SocialPostResource;
use App\Models\SocialPost;
use App\Services\Interfaces\SocialPostServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SocialPostShowController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly SocialPostServiceInterface $service
    ) {}

    public function __invoke(int $id)
    {
        $socialPost = $this->service->getSocialPostById($id);
        $this->authorize('view', $socialPost);
        return new SocialPostResource($socialPost);
    }
}

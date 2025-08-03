<?php

namespace App\Http\Controllers\API\SocialPost;

use App\Http\Controllers\Controller;
use App\Http\Requests\SocialPost\UpdateSocialPostRequest;
use App\Http\Resources\SocialPost\SocialPostResource;
use App\Models\SocialPost;
use App\Services\Interfaces\SocialPostServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SocialPostUpdateController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly SocialPostServiceInterface $service
    ) {}

    public function __invoke(UpdateSocialPostRequest $request, int $id)
    {
        $socialPost = $this->service->getSocialPostById($id);
        $this->authorize('update', $socialPost);
        $updatedSocialPost = $this->service->updateSocialPost($id, $request->toDto($socialPost));
        return new SocialPostResource($updatedSocialPost);
    }
}

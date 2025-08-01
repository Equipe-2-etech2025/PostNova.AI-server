<?php

namespace App\Http\Controllers\API\SocialPost;

use App\Http\Controllers\Controller;
use App\Http\Requests\SocialPost\CreateSocialPostRequest;
use App\Http\Resources\SocialPost\SocialPostResource;
use App\Models\SocialPost;
use App\Services\Interfaces\SocialPostServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SocialPostStoreController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly SocialPostServiceInterface $service
    ) {}

    public function __invoke(CreateSocialPostRequest $request)
    {
        $this->authorize('create', SocialPost::class);
        $socialPost = $this->service->createSocialPost($request->toDto());
        return new SocialPostResource($socialPost);
    }
}

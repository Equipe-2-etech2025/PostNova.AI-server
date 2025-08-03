<?php

namespace App\Http\Controllers\API\SocialPost;

use App\Http\Controllers\Controller;
use App\Http\Resources\SocialPost\SocialPostCollection;
use App\Models\SocialPost;
use App\Services\Interfaces\SocialPostServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class SocialPostIndexController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly SocialPostServiceInterface $service
    ) {}

    public function __invoke()
    {
        $user = Auth::user();
        $this->authorize('viewAny', SocialPost::class);

        $socialPosts = $user->hasRole('admin')
            ? $this->service->getAllSocialPosts()
            : $this->service->getSocialPostsByUserId($user->id);

        return new SocialPostCollection($socialPosts);
    }
}

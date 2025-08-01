<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SocialPost\CreateSocialPostRequest;
use App\Http\Requests\SocialPost\UpdateSocialPostRequest;
use App\Http\Resources\SocialPost\SocialPostCollection;
use App\Http\Resources\SocialPost\SocialPostResource;
use App\Models\Campaign;
use App\Models\SocialPost;
use App\Services\Interfaces\SocialPostServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Telescope\AuthorizesRequests;

class SocialPostController extends Controller
{
    use AuthorizesRequests;

    private SocialPostServiceInterface $socialPostService;

    public function __construct(SocialPostServiceInterface $socialPostService)
    {
        $this->socialPostService = $socialPostService;
    }

    public function index()
    {
        $user = Auth::user();

        $this->authorize('viewAny', SocialPost::class);

        if ($user->hasRole('admin')) {
            $socialPosts = $this->socialPostService->getAllSocialPosts();
        } else {
            $socialPosts = $this->socialPostService->getSocialPostsByUserId($user->id);
        }

        return new SocialPostCollection($socialPosts);
    }

    public function show(int $id)
    {
        $socialPost = $this->socialPostService->getSocialPostById($id);
        $this->authorize('view', $socialPost);
        return new SocialPostResource($socialPost);
    }

    public function store(CreateSocialPostRequest $request)
    {
        $socialPostDto = $request->toDto();
        $this->authorize('create', SocialPost::class);
        $socialPost = $this->socialPostService->createSocialPost($socialPostDto);

        return new SocialPostResource($socialPost);
    }

    public function update(UpdateSocialPostRequest $request, int $id)
    {
        $socialPost = $this->socialPostService->getSocialPostById($id);
        $this->authorize('update', $socialPost);
        $socialPostDto = $request->toDto($socialPost);
        $updatedSocialPost = $this->socialPostService->updateSocialPost($id, $socialPostDto);

        return new SocialPostResource($updatedSocialPost);
    }


    public function destroy(int $id)
    {
        $socialPost = $this->socialPostService->getSocialPostById($id);
        $this->authorize('delete', $socialPost);
        $this->socialPostService->deleteSocialPost($id);

        return response()->json(['message' => 'Supprimé avec succès.'], 200);
    }

    public function showByCriteria(Request $request)
    {
        $user = Auth::user();
        $this->authorize('viewAny', SocialPost::class);

        $criteria = $request->query();
        if (!$user->isAdmin()) {
            $criteria['user_id'] = $user->id;
        }

        $results = $this->socialPostService->getSocialPostByCriteria($criteria);

        return new SocialPostCollection($results);
    }


}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\SocialPostServiceInterface;
use Illuminate\Http\Request;
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
        return $this->socialPostService->getAllSocialPosts();
    }

    public function show(int $id)
    {
        return $this->socialPostService->getSocialPostById($id);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        return $this->socialPostService->createSocialPost($data);
    }

    public function update(Request $request, int $id)
    {
        $data = $request->all();
        return $this->socialPostService->updateSocialPost($id, $data);
    }

    public function destroy(int $id)
    {
        return $this->socialPostService->deleteSocialPost($id);
    }

    public function showByCriteria(Request $request)
    {
        $criteria = $request->all();
        return $this->socialPostService->getSocialPostByCriteria($criteria);
    }
}

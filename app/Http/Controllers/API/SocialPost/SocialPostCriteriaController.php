<?php

namespace App\Http\Controllers\API\SocialPost;

use App\Http\Controllers\Controller;
use App\Http\Resources\SocialPost\SocialPostCollection;
use App\Models\SocialPost;
use App\Services\Interfaces\SocialPostServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SocialPostCriteriaController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly SocialPostServiceInterface $service
    ) {}

    public function __invoke(Request $request)
    {
        $user = Auth::user();
        $this->authorize('viewAny', SocialPost::class);

        $criteria = $request->query();
        if (!$user->isAdmin()) {
            $criteria['user_id'] = $user->id;
        }

        $results = $this->service->getSocialPostByCriteria($criteria);
        return new SocialPostCollection($results);
    }
}

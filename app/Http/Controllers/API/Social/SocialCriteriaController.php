<?php

namespace App\Http\Controllers\API\Social;

use App\Http\Controllers\Controller;
use App\Http\Resources\Social\SocialCollection;
use App\Models\Social;
use App\Services\Interfaces\SocialServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SocialCriteriaController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly SocialServiceInterface $service
    ) {}

    public function __invoke(Request $request)
    {
        $user = Auth::user();
        $this->authorize('viewAny', Social::class);

        $criteria = $request->query();
        if (! $user->isAdmin()) {
            $criteria['user_id'] = $user->id;
        }

        $results = $this->service->getSocialByCriteria($criteria);

        return new SocialCollection($results);
    }
}

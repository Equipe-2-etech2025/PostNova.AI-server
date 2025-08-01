<?php

namespace App\Http\Controllers\API\LandingPage;

use App\Http\Controllers\Controller;
use App\Http\Resources\LandingPage\LandingPageCollection;
use App\Models\LandingPage;
use App\Services\Interfaces\LandingPageServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LandingPageCriteriaController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly LandingPageServiceInterface $service
    ) {}

    public function __invoke(Request $request)
    {
        $user = Auth::user();
        $this->authorize('viewAny', LandingPage::class);

        $criteria = $request->query();
        if (!$user->isAdmin()) {
            $criteria['user_id'] = $user->id;
        }

        $results = $this->service->getLandingPageByCriteria($criteria);
        return new LandingPageCollection($results);
    }
}

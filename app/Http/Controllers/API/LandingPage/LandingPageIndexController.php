<?php

namespace App\Http\Controllers\API\LandingPage;

use App\Http\Controllers\Controller;
use App\Http\Resources\LandingPage\LandingPageCollection;
use App\Models\Campaign;
use App\Services\Interfaces\LandingPageServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class LandingPageIndexController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly LandingPageServiceInterface $service
    ) {}

    public function __invoke()
    {
        $user = Auth::user();
        $this->authorize('viewAny', Campaign::class);

        $landingPages = $user->hasRole('admin')
            ? $this->service->getAllLandingPages()
            : $this->service->getLandingPageByUserId($user->id);

        return new LandingPageCollection($landingPages);
    }
}

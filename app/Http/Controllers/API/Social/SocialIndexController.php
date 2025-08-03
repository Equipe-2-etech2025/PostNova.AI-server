<?php

namespace App\Http\Controllers\API\Social;

use App\Http\Controllers\Controller;
use App\Http\Resources\Social\SocialCollection;
use App\Models\Social;
use App\Services\Interfaces\SocialServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SocialIndexController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly SocialServiceInterface $service
    ) {}

    public function __invoke()
    {
        $this->authorize('viewAny', Social::class);
        $socials = $this->service->getAllSocial();
        return new SocialCollection($socials);
    }
}

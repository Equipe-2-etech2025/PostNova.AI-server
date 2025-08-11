<?php

namespace App\Http\Controllers\API\Social;

use App\Http\Controllers\Controller;
use App\Http\Resources\Social\SocialResource;
use App\Services\Interfaces\SocialServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SocialShowController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly SocialServiceInterface $service
    ) {}

    public function __invoke(int $id)
    {
        $social = $this->service->getSocialById($id);
        $this->authorize('view', $social);

        return new SocialResource($social);
    }
}

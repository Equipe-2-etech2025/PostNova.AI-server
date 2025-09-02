<?php

namespace App\Http\Controllers\API\Social;

use App\Http\Controllers\Controller;
use App\Http\Requests\Social\CreateSocialRequest;
use App\Http\Resources\Social\SocialResource;
use App\Models\Social;
use App\Services\Interfaces\SocialServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SocialStoreController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly SocialServiceInterface $service
    ) {}

    public function __invoke(CreateSocialRequest $request)
    {
        $this->authorize('create', Social::class);
        $social = $this->service->createSocial($request->toDto());

        return new SocialResource($social);
    }
}

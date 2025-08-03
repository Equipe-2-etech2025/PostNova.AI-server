<?php

namespace App\Http\Controllers\API\Social;

use App\Http\Controllers\Controller;
use App\Http\Requests\Social\UpdateSocialRequest;
use App\Http\Resources\Social\SocialResource;
use App\Models\Social;
use App\Services\Interfaces\SocialServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SocialUpdateController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly SocialServiceInterface $service
    ) {}

    public function __invoke(UpdateSocialRequest $request, int $id)
    {
        $social = $this->service->getSocialById($id);
        $this->authorize('update', $social);
        $updatedSocial = $this->service->updateSocial($id, $request->toDto($social));
        return new SocialResource($updatedSocial);
    }
}

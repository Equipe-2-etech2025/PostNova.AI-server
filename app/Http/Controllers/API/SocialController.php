<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Social\CreateSocialRequest;
use App\Http\Requests\Social\UpdateSocialRequest;
use App\Http\Resources\Campaign\CampaignCollection;
use App\Http\Resources\Social\SocialCollection;
use App\Http\Resources\Social\SocialResource;
use App\Services\Interfaces\SocialServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use \App\Models\Social;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
{
    use AuthorizesRequests;

    private SocialServiceInterface $socialService;

    public function __construct(SocialServiceInterface $socialService)
    {
        $this->socialService = $socialService;
    }

    public function index()
    {
        $this->authorize('viewAny', Social::class);
        $social = $this->socialService->getAllSocial();
        return new SocialCollection($social);
    }

    public function show(int $id)
    {
        $social = $this->socialService->getSocialById($id);
        $this->authorize('view', $social);

        return new SocialResource($social);
    }

    public function store(CreateSocialRequest $request)
    {
        $socialDto = $request->toDto();
        $this->authorize('create', Social::class);
        $social = $this->socialService->createSocial($socialDto);

        return new SocialResource($social);
    }

    public function update(UpdateSocialRequest $request, int $id)
    {
        $social = $this->socialService->getSocialById($id);
        $this->authorize('update', $social);
        $socialDto = $request->toDto($social);
        $updatedSocial = $this->socialService->updateSocial($id, $socialDto);

        return new SocialResource($updatedSocial);
    }


    public function destroy(int $id)
    {
        $social = $this->socialService->getSocialById($id);
        $this->authorize('delete', $social);
        $this->socialService->deleteSocial($id);

        return response()->json(['message' => 'Supprimé avec succès.'], 200);
    }

    public function showByCriteria(Request $request)
    {
        $user = Auth::user();
        $this->authorize('viewAny', Social::class);

        $criteria = $request->query();
        if (!$user->isAdmin()) {
            $criteria['user_id'] = $user->id;
        }

        $results = $this->socialService->getSocialByCriteria($criteria);

        return new SocialCollection($results);
    }

}

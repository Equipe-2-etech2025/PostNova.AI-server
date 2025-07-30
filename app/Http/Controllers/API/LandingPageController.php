<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LandingPage\CreateLandingPageRequest;
use App\Http\Requests\LandingPage\UpdateLandingPageRequest;
use App\Http\Resources\LandingPage\LandingPageCollection;
use App\Http\Resources\LandingPage\LandingPageResource;
use App\Models\Campaign;
use App\Models\LandingPage;
use App\Services\Interfaces\LandingPageServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Telescope\AuthorizesRequests;

class LandingPageController extends Controller
{
    use AuthorizesRequests;

    private LandingPageServiceInterface $landingPageService;

    public function __construct(LandingPageServiceInterface $landingPageService)
    {
        $this->landingPageService = $landingPageService;
    }

    public function index()
    {
        $user = Auth::user();

        $this->authorize('viewAny', Campaign::class);

        if ($user->hasRole('admin')) {
            $landingPages = $this->landingPageService->getAllLandingPages();
        } else {
            $landingPages = $this->landingPageService->getLandingPageByUserId($user->id);
        }

        return new LandingPageCollection($landingPages);
    }

    public function show(int $id)
    {
        $landingPage = $this->landingPageService->getLandingPageById($id);
        $this->authorize('view', $landingPage);
        return new LandingPageResource($landingPage);
    }

    public function store(CreateLandingPageRequest $request)
    {
        $data = $request->validated();
        $this->authorize('create', [LandingPage::class, $data['campaign_id']]);
        $landingPage = $this->landingPageService->createLandingPage($data);

        return new  LandingPageResource($landingPage);
    }

    public function update(UpdateLandingPageRequest $request, int $id)
    {
        $landingPage = $this->landingPageService->getLandingPageById($id);
        $this->authorize('update', $landingPage);
        $landingPage = $this->landingPageService->updateLandingPage($id, $request->validated());

        return new LandingPageResource($landingPage);
    }

    public function destroy(int $id)
    {
        $landingPage = $this->landingPageService->getLandingPageById($id);
        $this->authorize('delete', $landingPage);
        $this->landingPageService->deleteLandingPage($id);

        return response()->json(['message' => 'Supprimé avec succès.'], 200);
    }

    public function showByCriteria(Request $request)
    {
        $landingPages = $this->landingPageService->getLandingPageByCriteria($request->query());

        return new LandingPageCollection($landingPages);
    }
}

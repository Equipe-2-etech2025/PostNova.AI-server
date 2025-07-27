<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\LandingPageServiceInterface;
use Illuminate\Http\Request;
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
        return $this->landingPageService->getAllLandingPages();
    }

    public function show(int $id)
    {
        return $this->landingPageService->getLandingPageById($id);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        return $this->landingPageService->createLandingPage($data);
    }

    public function update(Request $request, int $id)
    {
        $data = $request->all();
        return $this->landingPageService->updateLandingPage($id, $data);
    }

    public function destroy(int $id)
    {
        return $this->landingPageService->deleteLandingPage($id);
    }

    public function showByCriteria(Request $request)
    {
        return $this->landingPageService->getLandingPageByCriteria($request->query());
    }
}

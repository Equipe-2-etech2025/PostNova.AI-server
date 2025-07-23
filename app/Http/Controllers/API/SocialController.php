<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\CampaignServiceInterface;
use App\Services\Interfaces\SocialServiceInterface;
use App\Services\SocialService;
use Illuminate\Http\Request;
use Laravel\Telescope\AuthorizesRequests;

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
        return $this->socialService->getallSocial();
    }

    public function show(int $id)
    {
        return $this->socialService->getById($id);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        return $this->socialService->createSocial($data);
    }
    public function update(Request $request, int $id)
    {
        $data = $request->all();
        return $this->socialService->updateSocial($id, $data);
    }

    public function destroy(int $id){
        return $this->socialService->deleteSocial($id);
    }
}

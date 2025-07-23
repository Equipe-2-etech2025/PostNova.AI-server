<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\CampaignFeaturesServiceInterface;
use Illuminate\Http\Request;

class CampaignFeaturesController extends Controller
{
    private CampaignFeaturesServiceInterface $service;

    public function __construct(CampaignFeaturesServiceInterface $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->getAll();
    }

    public function show(int $id)
    {
        return $this->service->getById($id);
    }

    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    public function update(Request $request, int $id)
    {
        return $this->service->update($id, $request->all());
    }

    public function destroy(int $id)
    {
        return $this->service->delete($id);
    }

    public function showByCriteria(Request $request)
    {
        return $this->service->getByCriteria($request->all());
    }
}

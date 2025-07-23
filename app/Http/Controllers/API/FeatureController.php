<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\FeatureService;
use App\Services\Interfaces\FeatureServiceInterface;
use Illuminate\Http\Request;
use Laravel\Telescope\AuthorizesRequests;

class FeatureController extends Controller
{
    use AuthorizesRequests;
    protected FeatureServiceInterface $featureService;

    public function __construct(FeatureService $featureService)
    {
        $this->featureService = $featureService;
    }
   public function index()
   {
       return $this->featureService->getallFeature();
   }
   public function show($id)
   {
       return $this->featureService->getFeatureById($id);
   }
   public function showByCriteria(Request $request)
   {
       $criteria = $request->all();
       return $this->featureService->getFeatureByCriteria($criteria);
   }
   public function store(Request $request)
   {
       $query = $request->all();
       return $this->featureService->createFeature($query);
   }
    public function update($request, int $id)
    {
        $data = $request->all();
        return $this->featureService->updateFeature($id, $data);
    }
    public function destroy(int $id)
    {
        return $this->featureService->deleteFeature($id);
    }

}

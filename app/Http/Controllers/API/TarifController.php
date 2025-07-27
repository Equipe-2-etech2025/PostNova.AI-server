<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\TarifServiceInterface;
use Illuminate\Http\Request;
use Laravel\Telescope\AuthorizesRequests;

class TarifController extends Controller
{
    use AuthorizesRequests;

    private TarifServiceInterface $tarifService;

    public function __construct(TarifServiceInterface $tarifService)
    {
        $this->tarifService = $tarifService;
    }

    public function index()
    {
        return $this->tarifService->getAllTarifs();
    }

    public function show(int $id)
    {
        return $this->tarifService->getTarifById($id);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        return $this->tarifService->createTarif($data);
    }

    public function update(Request $request, int $id)
    {
        $data = $request->all();
        return $this->tarifService->updateTarif($id, $data);
    }

    public function destroy(int $id)
    {
        return $this->tarifService->deleteTarif($id);
    }

    public function showByCriteria(Request $request)
    {
        return $this->tarifService->getTarifByCriteria($request->query());
    }
}

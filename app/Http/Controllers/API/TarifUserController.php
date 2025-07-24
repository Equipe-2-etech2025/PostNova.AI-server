<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\TarifUserServiceInterface;
use Illuminate\Http\Request;
use Laravel\Telescope\AuthorizesRequests;

class TarifUserController extends Controller
{
    use AuthorizesRequests;

    private TarifUserServiceInterface $tarifUserService;

    public function __construct(TarifUserServiceInterface $tarifUserService)
    {
        $this->tarifUserService = $tarifUserService;
    }

    public function index()
    {
        return $this->tarifUserService->getAllTarifUsers();
    }

    public function show(int $id)
    {
        return $this->tarifUserService->getTarifUserById($id);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        return $this->tarifUserService->createTarifUser($data);
    }

    public function update(Request $request, int $id)
    {
        $data = $request->all();
        return $this->tarifUserService->updateTarifUser($id, $data);
    }

    public function destroy(int $id)
    {
        return $this->tarifUserService->deleteTarifUser($id);
    }

    public function showByCriteria(Request $request)
    {
        $criteria = $request->all();
        return $this->tarifUserService->getTarifUserByCriteria($criteria);
    }
}

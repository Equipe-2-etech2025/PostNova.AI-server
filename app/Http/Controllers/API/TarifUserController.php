<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TarifUser\CreateTarifUserRequest;
use App\Http\Requests\TarifUser\UpdateTarifUserRequest;
use App\Http\Resources\TarifUser\TarifUserResource;
use App\Http\Resources\TarifUser\TarifUserCollection;
use App\Services\Interfaces\TarifUserServiceInterface;
use Illuminate\Http\Request;
use App\Models\TarifUser;
use Illuminate\Support\Facades\Auth;

class TarifUserController extends Controller
{
    private TarifUserServiceInterface $tarifUserService;

    public function __construct(TarifUserServiceInterface $tarifUserService)
    {
        $this->tarifUserService = $tarifUserService;
    }

    public function index()
    {
        $this->authorize('viewAny', TarifUser::class);
        $tarifUsers = $this->tarifUserService->getAllTarifUsers();
        return new TarifUserCollection($tarifUsers);
    }

    public function show(int $id)
    {
        $tarifUser = $this->tarifUserService->getTarifUserById($id);
        $this->authorize('view', $tarifUser);
        return new TarifUserResource($tarifUser);
    }

    public function store(CreateTarifUserRequest $request)
    {
        $this->authorize('create', TarifUser::class);

        $tarifUserDto = $request->toDto();
        $tarifUser = $this->tarifUserService->createTarifUser($tarifUserDto);

        return new TarifUserResource($tarifUser);
    }

    public function update(UpdateTarifUserRequest $request, int $id)
    {
        $tarifUser = $this->tarifUserService->getTarifUserById($id);
        $this->authorize('update', $tarifUser);

        $tarifUserDto = $request->toDto($tarifUser);
        $updated = $this->tarifUserService->updateTarifUser($id, $tarifUserDto);

        return new TarifUserResource($updated);
    }


    public function destroy(int $id)
    {
        $tarifUser = $this->tarifUserService->getTarifUserById($id);
        $this->authorize('delete', $tarifUser);
        $this->tarifUserService->deleteTarifUser($id);

        return response()->json(['message' => 'Supprimé avec succès.'], 200);
    }

    public function showByCriteria(Request $request)
    {
        $user = Auth::user();
        $this->authorize('viewAny', TarifUser::class);

        $criteria = $request->query();
        if (!$user->isAdmin()) {
            $criteria['user_id'] = $user->id;
        }

        $results = $this->tarifUserService->getTarifUserByCriteria($criteria);

        return new TarifUserCollection($results);
    }

}

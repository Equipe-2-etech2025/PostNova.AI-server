<?php
namespace App\Http\Controllers\API\TarifUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\TarifUser\UpdateTarifUserRequest;
use App\Http\Resources\TarifUser\TarifUserResource;
use App\Models\TarifUser;
use App\Services\Interfaces\TarifUserServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TarifUserUpdateController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private TarifUserServiceInterface $service
    ) {}

    public function __invoke(UpdateTarifUserRequest $request, int $id)
    {
        $tarifUser = $this->service->getTarifUserById($id);
        $this->authorize('update', $tarifUser);
        return new TarifUserResource(
            $this->service->updateTarifUser($id, $request->toDto($tarifUser))
        );
    }
}

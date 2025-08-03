<?php
namespace App\Http\Controllers\API\TarifUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\TarifUser\CreateTarifUserRequest;
use App\Http\Resources\TarifUser\TarifUserResource;
use App\Models\TarifUser;
use App\Services\Interfaces\TarifUserServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TarifUserStoreController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private TarifUserServiceInterface $service
    ) {}

    public function __invoke(CreateTarifUserRequest $request)
    {
        $this->authorize('create', TarifUser::class);
        return new TarifUserResource(
            $this->service->createTarifUser($request->toDto())
        );
    }
}

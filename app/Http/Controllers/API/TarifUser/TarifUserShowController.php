<?php
namespace App\Http\Controllers\API\TarifUser;

use App\Http\Controllers\Controller;
use App\Http\Resources\TarifUser\TarifUserResource;
use App\Models\TarifUser;
use App\Services\Interfaces\TarifUserServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TarifUserShowController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private TarifUserServiceInterface $service
    ) {}

    public function __invoke(int $id)
    {
        $tarifUser = $this->service->getTarifUserById($id);
        $this->authorize('view', $tarifUser);
        return new TarifUserResource($tarifUser);
    }
}

<?php
namespace App\Http\Controllers\API\TarifUser;

use App\Http\Controllers\Controller;
use App\Http\Resources\TarifUser\TarifUserCollection;
use App\Models\TarifUser;
use App\Services\Interfaces\TarifUserServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TarifUserIndexController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private TarifUserServiceInterface $service
    ) {}

    public function __invoke()
    {
        $this->authorize('viewAny', TarifUser::class);
        return new TarifUserCollection($this->service->getAllTarifUsers());
    }
}

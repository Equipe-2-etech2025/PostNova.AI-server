<?php

namespace App\Http\Controllers\API\Tarif;

use App\Http\Controllers\Controller;
use App\Http\Resources\Tarif\TarifCollection;
use App\Models\Tarif;
use App\Services\Interfaces\TarifServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TarifCriteriaController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly TarifServiceInterface $service
    ) {}

    public function __invoke(Request $request)
    {
        $user = Auth::user();
        $this->authorize('viewAny', Tarif::class);

        $criteria = $request->query();
        if (! $user->isAdmin()) {
            $criteria['user_id'] = $user->id;
        }

        $results = $this->service->getTarifByCriteria($criteria);

        return new TarifCollection($results);
    }
}

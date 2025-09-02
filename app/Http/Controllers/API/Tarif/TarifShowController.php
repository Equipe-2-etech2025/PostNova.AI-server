<?php

namespace App\Http\Controllers\API\Tarif;

use App\Http\Controllers\Controller;
use App\Http\Resources\Tarif\TarifResource;
use App\Services\Interfaces\TarifServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TarifShowController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly TarifServiceInterface $service
    ) {}

    public function __invoke(int $id)
    {
        $tarif = $this->service->getTarifById($id);
        $this->authorize('view', $tarif);

        return new TarifResource($tarif);
    }
}

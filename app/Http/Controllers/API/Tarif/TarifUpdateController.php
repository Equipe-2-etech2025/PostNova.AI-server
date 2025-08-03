<?php

namespace App\Http\Controllers\API\Tarif;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tarif\UpdateTarifRequest;
use App\Http\Resources\Tarif\TarifResource;
use App\Models\Tarif;
use App\Services\Interfaces\TarifServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TarifUpdateController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly TarifServiceInterface $service
    ) {}

    public function __invoke(UpdateTarifRequest $request, int $id)
    {
        $tarif = $this->service->getTarifById($id);
        $this->authorize('update', $tarif);
        $updatedTarif = $this->service->updateTarif($id, $request->toDto($tarif));
        return new TarifResource($updatedTarif);
    }
}

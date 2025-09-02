<?php

namespace App\Http\Controllers\API\Tarif;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tarif\CreateTarifRequest;
use App\Http\Resources\Tarif\TarifResource;
use App\Models\Tarif;
use App\Services\Interfaces\TarifServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TarifStoreController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly TarifServiceInterface $service
    ) {}

    public function __invoke(CreateTarifRequest $request)
    {
        $this->authorize('create', Tarif::class);
        $tarif = $this->service->createTarif($request->toDto());

        return new TarifResource($tarif);
    }
}

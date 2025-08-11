<?php

namespace App\Http\Controllers\API\Tarif;

use App\Http\Controllers\Controller;
use App\Http\Resources\Tarif\TarifCollection;
use App\Services\Interfaces\TarifServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TarifIndexController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly TarifServiceInterface $service
    ) {}

    public function __invoke()
    {
        $tarifs = $this->service->getAllTarifs();

        return new TarifCollection($tarifs);
    }
}

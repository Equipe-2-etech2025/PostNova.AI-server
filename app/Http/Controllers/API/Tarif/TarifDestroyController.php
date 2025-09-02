<?php

namespace App\Http\Controllers\API\Tarif;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\TarifServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

class TarifDestroyController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly TarifServiceInterface $service
    ) {}

    public function __invoke(int $id): JsonResponse
    {
        $tarif = $this->service->getTarifById($id);
        $this->authorize('delete', $tarif);
        $this->service->deleteTarif($id);

        return response()->json(['message' => 'Supprimé avec succès.'], 200);
    }
}

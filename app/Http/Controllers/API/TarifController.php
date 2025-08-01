<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tarif\CreateTarifRequest;
use App\Http\Requests\Tarif\UpdateTarifRequest;
use App\Http\Resources\Tarif\TarifCollection;
use App\Http\Resources\Tarif\TarifRessource;
use App\Models\Tarif;
use App\Services\Interfaces\TarifServiceInterface;
use Illuminate\Http\Request;

class TarifController extends Controller
{
    private TarifServiceInterface $tarifService;

    public function __construct(TarifServiceInterface $tarifService)
    {
        $this->tarifService = $tarifService;
    }

    public function index()
    {
        $tarifs = $this->tarifService->getAllTarifs();
        return new TarifCollection($tarifs);
    }

    public function show(int $id)
    {
        $tarif = $this->tarifService->getTarifById($id);
        $this->authorize('view', $tarif);

        return new TarifRessource($tarif);
    }

    public function store(CreateTarifRequest $request)
    {
        $this->authorize('create', Tarif::class);
        $tarif = $this->tarifService->createTarif($request->validated());

        return new TarifRessource($tarif);
    }

    public function update(UpdateTarifRequest $request, int $id)
    {
        $tarif = $this->tarifService->getTarifById($id);
        $this->authorize('update', $tarif);

        $updatedTarif = $this->tarifService->updateTarif($id, $request->validated());
        return new TarifRessource($updatedTarif);
    }

    public function destroy(int $id)
    {
        $tarif = $this->tarifService->getTarifById($id);
        $this->authorize('delete', $tarif);
        $this->tarifService->deleteTarif($id);

        return response()->json(['message' => 'Supprimé avec succès.'], 200);

    }

    public function showByCriteria(Request $request)
    {
        $tarifs = $this->tarifService->getTarifByCriteria($request->query());
        return new TarifCollection($tarifs);
    }
}

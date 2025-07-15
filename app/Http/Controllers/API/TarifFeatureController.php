<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TarifFeature;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TarifFeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $query = TarifFeature::query();

        // Recherche par contenu
        if ($request->has('search')) {
            $query->searchByContent($request->search);
        }

        // Filtrage par date de création
        if ($request->has('created_after')) {
            $query->createdAfter($request->created_after);
        }

        // Tri
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        // Pagination
        $perPage = $request->get('per_page', 15);
        $features = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $features,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $feature = TarifFeature::create([
            'content' => $request->content,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Feature créée avec succès',
            'data' => $feature,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(TarifFeature $tarifFeature): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $tarifFeature,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TarifFeature $tarifFeature): JsonResponse
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $tarifFeature->update([
            'content' => $request->content,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Feature mise à jour avec succès',
            'data' => $tarifFeature,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TarifFeature $tarifFeature): JsonResponse
    {
        $tarifFeature->delete();

        return response()->json([
            'success' => true,
            'message' => 'Feature supprimée avec succès',
        ]);
    }
}

<?php

namespace App\Http\Controllers\API\Suggestion;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\SuggestionServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class SuggestionController extends Controller
{
    public function __construct(
        private readonly SuggestionServiceInterface $suggestionService
    ) {}

    /**
     * Handle the incoming request to get suggestions for the authenticated user.
     */
    public function __invoke(int $userId): JsonResponse
    {
        try {
            $suggestions = $this->suggestionService->getSuggestions($userId);

            return response()->json([
                'suggestions' => $suggestions,
            ]);
        } catch (\Throwable $e) {
            Log::error('Erreur getSuggestions: '.$e->getMessage());

            return response()->json([
                'message' => 'Une erreur est survenue lors de la récupération des suggestions.',
            ], 500);
        }
    }
}

<?php

namespace App\Http\Controllers\API\CampaignTemplate;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\TemplateRatingServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

class TemplateRatingController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly TemplateRatingServiceInterface $service
    ) {}

    /**
     * Upsert (create/update) le rating d'un utilisateur pour un template
     */
    public function __invoke(Request $request, int $templateId): JsonResponse
    {
        $request->validate([
            'rating' => 'required|numeric|min:0|max:5',
        ]);

        $userId = auth()->id();
        $ratingValue = floatval($request->input('rating'));

        $rating = $this->service->upsertRating($templateId, $userId, $ratingValue);

        return response()->json([
            'success' => true,
            'message' => 'Rating enregistré avec succès',
            'data' => $rating,
        ]);
    }
}

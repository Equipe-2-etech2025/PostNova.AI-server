<?php

namespace App\Http\Controllers\API\SocialPost;

use App\Http\Controllers\Controller;
use App\Http\Requests\SocialPost\RegenerateSocialPostRequest;
use App\Services\SocialPost\SocialPostRegenerateService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;

class SocialPostRegenerateController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly SocialPostRegenerateService $regenerateService
    ) {}

    /**
     * Régénère et met à jour un post social existant
     */
    public function __invoke(RegenerateSocialPostRequest $request, $postId)
    {
        try {
            $updatedPosts = $this->regenerateService->regenerateAndUpdatePost(
                $postId,
                $request->validated()
            );

            if (empty($updatedPosts)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Aucun contenu généré. Veuillez détailler davantage votre requête.',
                    'type' => 'no_content',
                ], 422);
            }

            $updatedPost = $updatedPosts[0];

            $updatedPost['platform'] = $this->getPlatformName($updatedPost['social_id']);

            return response()->json([
                'success' => true,
                'data' => $updatedPost,
                'message' => 'Post régénéré avec succès',
            ], 200);

        } catch (\Exception $e) {
            Log::error('Erreur régénération post', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la régénération: '.$e->getMessage(),
                'type' => 'regeneration_error',
            ], 500);
        }
    }

    private function getPlatformName($socialId)
    {
        return match ($socialId) {
            1 => 'tiktok',
            2 => 'x',
            3 => 'linkedin',
            default => 'unknown'
        };
    }
}

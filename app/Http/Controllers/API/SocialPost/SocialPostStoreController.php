<?php

namespace App\Http\Controllers\API\SocialPost;

use App\Http\Controllers\Controller;
use App\Http\Requests\SocialPost\CreateSocialPostRequest;
use App\Http\Resources\SocialPost\SocialPostResource;
use App\Services\Interfaces\SocialPostServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

class SocialPostStoreController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly SocialPostServiceInterface $service
    ) {}

    public function __invoke(CreateSocialPostRequest $request): JsonResponse|SocialPostResource
    {
        $socialPostDto = $request->toDto();

        if (empty($socialPostDto->content) ||
            stripos($socialPostDto->content, 'aucun contenu disponible') !== false ||
            $this->isInvalidContent($socialPostDto->content)) {

            return response()->json([
                'success' => false,
                'type' => 'no_content',
            ], 422);
        }

        if (! $socialPostDto->prompt_id) {
            return response()->json([
                'success' => false,
                'message' => 'Le prompt est requis',
                'type' => 'prompt_required',
            ], 422);
        }

        $socialPost = $this->service->createSocialPost($socialPostDto);
        $this->authorize('create', $socialPost);

        return new SocialPostResource($socialPost);
    }

    /**
     * Vérifie si le contenu est invalide
     */
    private function isInvalidContent(string $content): bool
    {
        $invalidPatterns = [
            '/aucun contenu disponible/i',
            '/no content available/i',
            '/contenu non disponible/i',
            '/^[\s\W]*$/i',
        ];

        foreach ($invalidPatterns as $pattern) {
            if (preg_match($pattern, $content)) {
                return true;
            }
        }

        return empty(trim($content));
    }
}

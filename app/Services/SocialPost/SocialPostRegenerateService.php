<?php

namespace App\Services\SocialPost;

use App\DTOs\SocialPost\SocialPostDto;
use App\Repositories\Interfaces\CampaignRepositoryInterface;
use App\Repositories\SocialPostRepository;
use Illuminate\Support\Facades\Log;

class SocialPostRegenerateService
{
    public function __construct(
        private readonly SocialPostRepository $socialPostRepository,
        private readonly CampaignRepositoryInterface $campaignRepository,
        private readonly SocialPostGeneratorService $generatorService,
        private readonly SocialPostValidationService $validationService
    ) {}

    /**
     * Régénère et met à jour un post social existant
     */
    public function regenerateAndUpdatePost(int $postId, array $params): array
    {
        try {
            $existingPost = $this->socialPostRepository->find($postId);
            if (! $existingPost) {
                throw new \Exception('Post social non trouvé');
            }

            $platform = $params['platform'] ?? $this->getPlatformFromSocialId($existingPost->social_id);

            $results = $this->generatorService->generateForPlatforms([
                'topic' => $params['topic'],
                'platforms' => [$platform],
                'campaign_id' => $params['campaign_id'],
                'tone' => $params['tone'] ?? null,
                'language' => $params['language'] ?? 'french',
                'hashtags' => $params['hashtags'] ?? '',
                'target_audience' => $params['target_audience'] ?? '',
            ]);

            $updatedPosts = [];

            foreach ($results as $platform => $post) {
                if ($this->validationService->isInvalidContent($post['content'])) {
                    Log::warning("Contenu vide pour la plateforme $platform, post non mis à jour");

                    continue;
                }

                $dto = new SocialPostDto(
                    $postId,
                    content: $post['content'],
                    campaign_id: $params['campaign_id'],
                    social_id: $this->generatorService->getSocialIdFromPlatform($platform),
                    is_published: $params['is_published'] ?? $existingPost->is_published,
                    prompt_id: $params['prompt_id'],
                );

                $updatedPost = $this->socialPostRepository->update($postId, $dto);
                $updatedPosts[] = $updatedPost->toArray();
            }

            return $updatedPosts;

        } catch (\Exception $e) {
            Log::error('Erreur lors de la régénération du post', [
                'post_id' => $postId,
                'error' => $e->getMessage(),
            ]);
            throw $e;
        }
    }

    /**
     * Obtenir le nom de la plateforme à partir de l'ID social
     */
    private function getPlatformFromSocialId(int $socialId): string
    {
        return match ($socialId) {
            1 => 'tiktok',
            2 => 'x',
            3 => 'linkedin',
            default => 'linkedin'
        };
    }

    /**
     * Régénère le contenu sans mettre à jour la base de données
     */
    public function regenerateContentOnly(array $params): array
    {
        return $this->generatorService->generateForPlatforms($params);
    }
}

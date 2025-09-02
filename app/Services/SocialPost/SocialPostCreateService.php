<?php

namespace App\Services\SocialPost;

use App\DTOs\SocialPost\SocialPostDto;
use App\Repositories\SocialPostRepository;
use Illuminate\Support\Facades\Log;

class SocialPostCreateService
{
    public function __construct(
        private readonly SocialPostRepository $socialPostRepository,
        private readonly SocialPostGeneratorService $generatorService,
        private readonly SocialPostValidationService $validationService
    ) {}

    /**
     * Génère et crée directement les posts sociaux en base
     */
    public function generateAndCreateForPlatforms(array $params): array
    {
        $results = $this->generatorService->generateForPlatforms($params);
        $createdPosts = [];

        foreach ($results as $platform => $post) {
            if ($this->validationService->isInvalidContent($post['content'])) {
                Log::warning("Contenu vide pour la plateforme $platform, post non créé");

                continue;
            }

            $dto = new SocialPostDto(
                null,
                content: $post['content'],
                campaign_id: $params['campaign_id'],
                social_id: $this->generatorService->getSocialIdFromPlatform($platform),
                is_published: $params['is_published'] ?? false,
                prompt_id: $params['prompt_id']
            );

            $createdPosts[] = $this->socialPostRepository->create($dto);
        }

        return $createdPosts;
    }
}

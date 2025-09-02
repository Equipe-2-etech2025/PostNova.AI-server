<?php

namespace App\Services\SocialPost;

use App\Repositories\Interfaces\CampaignRepositoryInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SocialPostGeneratorService
{
    public function __construct(
        private readonly CampaignRepositoryInterface $campaignRepository,
        private readonly SocialPostPlatformManager $platformManager,
        private readonly SocialPostPromptBuilder $promptBuilder,
        private readonly SocialPostResponseParser $responseParser
    ) {}

    /**
     * Génère les posts pour les plateformes
     */
    public function generateForPlatforms(array $params): array
    {
        $results = [];
        $platforms = $params['platforms'] ?? ['linkedin', 'x', 'tiktok'];

        $campaignInfo = $this->getCampaignInfo($params['campaign_id']);

        foreach ($platforms as $platform) {
            try {
                $results[$platform] = $this->generateForPlatform(
                    $params['topic'],
                    $platform,
                    $params['tone'] ?? null,
                    $params['language'] ?? 'french',
                    $params['hashtags'] ?? '',
                    $params['target_audience'] ?? '',
                    $campaignInfo
                );
            } catch (\Exception $e) {
                Log::error("Failed to generate $platform post", ['error' => $e]);
                $results[$platform] = ['content' => '', 'hashtags' => '', 'platform' => $platform, 'optimized' => false];
            }
        }

        return $results;
    }

    private function generateForPlatform(
        string $topic,
        string $platform,
        ?string $tone,
        string $language,
        string $hashtags,
        string $targetAudience,
        array $campaignInfo = []
    ): array {
        $specs = $this->platformManager->getPlatformSpecs($platform);
        $prompt = $this->promptBuilder->buildPlatformPrompt(
            $topic,
            $platform,
            $tone ?? $specs['tone'],
            $language,
            $hashtags,
            $targetAudience,
            $campaignInfo
        );

        $response = Http::retry(3, 500)
            ->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key='.config('services.gemini.api_key'), [
                'contents' => [['parts' => [['text' => $prompt]]]],
                'generationConfig' => ['maxOutputTokens' => $specs['max_length']],
            ]);

        if (! $response->successful()) {
            throw new \RuntimeException("API request failed for $platform");
        }

        return $this->responseParser->parseResponse($response->json(), $platform);
    }

    /**
     * Récupère les informations de la campagne
     */
    private function getCampaignInfo(int $campaignId): array
    {
        try {
            $campaign = $this->campaignRepository->find($campaignId);

            return [
                'name' => $campaign->name ?? '',
                'description' => $campaign->description ?? '',
                'type' => $campaign->typeCampaign->name ?? '',
            ];
        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération de la campagne', ['error' => $e]);

            return [];
        }
    }

    public function getSocialIdFromPlatform(string $platform): int
    {
        return $this->platformManager->getSocialIdFromPlatform($platform);
    }
}

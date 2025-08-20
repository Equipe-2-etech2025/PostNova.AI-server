<?php

namespace App\Services\SocialPost;

use App\Models\SocialPost;
use App\Repositories\SocialPostRepository;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\DTOs\SocialPost\SocialPostDto;

class SocialPostCreateService
{
    private array $platformSpecs = [
        'linkedin' => ['max_length' => 3000, 'hashtag_count' => 7, 'tone' => 'professionnel', 'emoji' => '✅💼🚀'],
        'x'  => ['max_length' => 3000, 'hashtag_count' => 5, 'tone' => 'concise', 'emoji' => '🐦💬🔥'],
        'tiktok'   => ['max_length' => 3000, 'hashtag_count' => 5, 'tone' => 'jeune et dynamique', 'emoji' => '🎵🕺💥']
    ];

    public function __construct(
        private readonly SocialPostRepository $socialPostRepository
    ) {}

    /**
     * Génère et crée directement les posts sociaux en base
     */

    public function generateAndCreateForPlatforms(array $params): array
    {
        $results = $this->generateForPlatforms($params);

        $createdPosts = [];

        foreach ($results as $platform => $post) {
            $dto = new SocialPostDto(
                null,
                content: $post['content'],
                campaign_id: $params['campaign_id'],
                social_id: $this->getSocialIdFromPlatform($platform),
                is_published: $params['is_published'] ?? false
            );

            $createdPosts[] = $this->socialPostRepository->create($dto);
        }

        return $createdPosts;
    }


    /**
     * Génère les posts pour les plateformes (sans les enregistrer)
     */
    public function generateForPlatforms(array $params): array
    {
        $results = [];
        $platforms = $params['platforms'] ?? ['linkedin', 'x', 'tiktok'];

        foreach ($platforms as $platform) {
            try {
                $results[$platform] = $this->generateForPlatform(
                    $params['topic'],
                    $platform,
                    $params['tone'] ?? null,
                    $params['language'] ?? 'french',
                    $params['hashtags'] ?? '',
                    $params['target_audience'] ?? ''
                );
            } catch (\Exception $e) {
                Log::error("Failed to generate $platform post", ['error' => $e]);
                $results[$platform] = $this->generateFallbackPost($params['topic'], $platform);
            }
        }

        return $results;
    }

    private function generateForPlatform(string $topic, string $platform, ?string $tone, string $language, string $hashtags, string $targetAudience): array
    {
        $specs = $this->platformSpecs[$platform] ?? $this->platformSpecs['linkedin'];
        $prompt = $this->buildPlatformPrompt($topic, $platform, $tone ?? $specs['tone'], $language, $hashtags, $targetAudience);

        $response = Http::retry(3, 500)
            ->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key='.config('services.gemini.api_key'), [
                'contents' => [['parts' => [['text' => $prompt]]]],
                'generationConfig' => ['maxOutputTokens' => $specs['max_length']]
            ]);

        if (!$response->successful()) {
            throw new \RuntimeException("API request failed for $platform");
        }

        return $this->parseResponse($response->json(), $platform);
    }

    private function buildPlatformPrompt(string $topic, string $platform, string $tone, string $language, string $hashtags, string $targetAudience): string
    {
        $specs = $this->platformSpecs[$platform];

        return <<<PROMPT
        Crée un post $platform en $language sur le thème: "$topic"
        - Ton: $tone {$specs['emoji']}
        - Public: $targetAudience
        - Insère un titre, des paragraphes clairs et des retours à la ligne pour faciliter la lecture.
        - Ajoute des emojis adaptés pour attirer l'attention.
        - Longueur max: {$specs['max_length']} caractères
        - Hashtags: génère jusqu'à {$specs['hashtag_count']} hashtags pertinents à la fin du post.
        - Chaque hashtag doit commencer par # et être séparé par un espace.
        - Les hashtags doivent être mis en gras dans le texte si possible (ex: **#marketing**).

        Format de réponse STRICT:
        CONTENU:
        [texte complet du post avec retours à la ligne et hashtags à la fin]
        HASHTAGS:
        [#hashtag1 #hashtag2 ...]

        Le post doit:
        1. Attirer l'attention
        2. Être adapté à $platform
        3. Inclure des mots-clés pertinents et les hashtags à la fin

        PROMPT;
    }

    private function parseResponse(array $apiResponse, string $platform): array
    {
        $text = $apiResponse['candidates'][0]['content']['parts'][0]['text'] ?? '';

        preg_match('/CONTENU:(.+?)HASHTAGS:(.+)/s', $text, $matches);

        $content = $matches[1] ?? $text;
        $hashtagsRaw = $matches[2] ?? '';

        preg_match_all('/#\w[\w-]*/', $content . ' ' . $hashtagsRaw, $hashtagsMatches);

        $hashtags = implode(' ', array_unique($hashtagsMatches[0]));

        return [
            'content' => trim($content),
            'hashtags' => $hashtags ?: $this->generateFallbackHashtags($platform),
            'platform' => $platform,
            'optimized' => true
        ];
    }

    private function generateFallbackPost(string $topic, string $platform): array
    {
        return [
            'content' => "Découvrez notre nouveau thème: $topic",
            'hashtags' => $this->generateFallbackHashtags($platform),
            'platform' => $platform,
            'optimized' => false
        ];
    }

    private function generateFallbackHashtags(string $platform): string
    {
        return match($platform) {
            'x' => 'marketing socialmedia',
            'tiktok' => 'viral trending',
            default => 'marketing digital innovation'
        };
    }

    private function generateTopicHint(string $platform): string
    {
        return match($platform) {
            'x' => "notre actualité #exclusivité",
            'tiktok' => "notre nouveau défi 👀",
            default => "notre nouvelle campagne"
        };
    }

    private function getSocialIdFromPlatform(string $platform): int
    {
        return match(strtolower($platform)) {
            'tiktok' => 1,
            'x' => 2,
            'linkedin' => 3,
            default => throw new \InvalidArgumentException("Plateforme inconnue: $platform")
        };
    }
}

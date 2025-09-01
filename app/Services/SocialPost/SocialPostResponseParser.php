<?php

namespace App\Services\SocialPost;

class SocialPostResponseParser
{
    public function __construct(
        private readonly SocialPostPlatformManager $platformManager
    ) {}

    public function parseResponse(array $apiResponse, string $platform): array
    {
        $text = $apiResponse['candidates'][0]['content']['parts'][0]['text'] ?? '';

        preg_match('/CONTENU:(.+?)HASHTAGS:(.+)/s', $text, $matches);

        $content = $matches[1] ?? $text;
        $hashtagsRaw = $matches[2] ?? '';

        preg_match_all('/#\w[\w-]*/', $content.' '.$hashtagsRaw, $hashtagsMatches);

        $hashtags = implode(' ', array_unique($hashtagsMatches[0]));

        return [
            'content' => trim($content),
            'hashtags' => $hashtags ?: $this->platformManager->generateFallbackHashtags($platform),
            'platform' => $platform,
            'optimized' => true,
        ];
    }
}

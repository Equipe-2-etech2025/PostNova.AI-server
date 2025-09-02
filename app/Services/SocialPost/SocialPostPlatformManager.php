<?php

namespace App\Services\SocialPost;

class SocialPostPlatformManager
{
    private array $platformSpecs = [
        'linkedin' => [
            'max_length' => 3000,
            'hashtag_count' => 7,
            'tone' => 'professionnel',
            'emoji' => '✅💼🚀',
        ],
        'x' => [
            'max_length' => 3000,
            'hashtag_count' => 5,
            'tone' => 'concise',
            'emoji' => '🐦💬🔥',
        ],
        'tiktok' => [
            'max_length' => 3000,
            'hashtag_count' => 5,
            'tone' => 'jeune et dynamique',
            'emoji' => '🎵🕺💥',
        ],
    ];

    public function getPlatformSpecs(string $platform): array
    {
        return $this->platformSpecs[$platform] ?? $this->platformSpecs['linkedin'];
    }

    public function getSocialIdFromPlatform(string $platform): int
    {
        return match (strtolower($platform)) {
            'tiktok' => 1,
            'x' => 2,
            'linkedin' => 3,
            default => throw new \InvalidArgumentException("Plateforme inconnue: $platform")
        };
    }

    public function generateFallbackHashtags(string $platform): string
    {
        return match ($platform) {
            'x' => 'marketing socialmedia',
            'tiktok' => 'viral trending',
            default => 'marketing digital innovation'
        };
    }

    public function getAvailablePlatforms(): array
    {
        return array_keys($this->platformSpecs);
    }
}

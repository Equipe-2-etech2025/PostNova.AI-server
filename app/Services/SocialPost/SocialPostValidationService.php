<?php

namespace App\Services\SocialPost;

class SocialPostValidationService
{
    public function isInvalidContent(string $content): bool
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

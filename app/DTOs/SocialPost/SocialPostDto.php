<?php

namespace App\DTOs\SocialPost;

use DateTimeInterface;

class SocialPostDto
{
    public function __construct(
        public readonly ?int $id,
        public readonly ?string $content,
        public readonly ?int $campaign_id,
        public readonly ?int $social_id,
        public readonly bool $is_published = false
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            'campaign_id' => $this->campaign_id,
            'social_id' => $this->social_id,
            'is_published' => $this->is_published
        ];
    }
}

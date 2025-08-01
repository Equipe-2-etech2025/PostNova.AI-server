<?php

namespace App\DTOs\SocialPost;

class SocialPostDto
{
    public function __construct(
        public readonly ?string $content,
        public readonly ?string $image_url,
        public readonly ?int $campaign_id,
        public readonly ?int $user_id,
        public readonly bool $is_published = false
    ) {}

    public function toArray(): array
    {
        return [
            'content' => $this->content,
            'image_url' => $this->image_url,
            'campaign_id' => $this->campaign_id,
            'user_id' => $this->user_id,
            'is_published' => $this->is_published,
        ];
    }
}

<?php

namespace App\DTOs\LandingPage;

class LandingPageDto
{
    public function __construct(
        public readonly ?string $title,
        public readonly ?string $content,
        public readonly ?int $campaign_id,
        public readonly bool $is_published = false
    ) {}

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'content' => $this->content,
            'campaign_id' => $this->campaign_id,
            'is_published' => $this->is_published,
        ];
    }
}

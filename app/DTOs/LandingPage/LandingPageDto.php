<?php

namespace App\DTOs\LandingPage;

class LandingPageDto
{
    public function __construct(
        public readonly ?int $id,
        public readonly ?string $path,
        public readonly ?array $content,
        public readonly ?int $campaign_id,
        public readonly bool $is_published = false
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'path' => $this->path,
            'content' => $this->content,
            'campaign_id' => $this->campaign_id,
            'is_published' => $this->is_published,
        ];
    }
}

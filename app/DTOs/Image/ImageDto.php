<?php

namespace App\DTOs\Image;

class ImageDto
{
    public function __construct(
        public readonly ?int $id,
        public readonly ?string $path,
        public readonly ?int $campaign_id,
        public readonly ?int $prompt_id,
        public readonly bool $is_published = false
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'path' => $this->path,
            'campaign_id' => $this->campaign_id,
            'prompt_id' => $this->prompt_id,
            'is_published' => $this->is_published,
        ];
    }
}

<?php

namespace App\DTOs\Image;

class ImageDto
{
    public function __construct(
        public readonly ?string $path,
        public readonly ?int $campaign_id,
        public readonly bool $is_published = false
    ) {}

    public function toArray(): array
    {
        return [
            'path' => $this->path,
            'campaign_id' => $this->campaign_id,
            'is_published' => $this->is_published,
        ];
    }
}

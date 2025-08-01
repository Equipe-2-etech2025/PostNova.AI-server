<?php

namespace App\DTOs\Social;

class SocialDto
{
    public function __construct(
        public readonly ?int $id,
        public readonly ?string $name,
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}

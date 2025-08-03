<?php

namespace App\DTOs\Features;

class FeaturesDto
{
    public function __construct(
        public readonly ?string $name,
    ) {}

    public function toArray(): array
    {
        return [
            'name' => $this->name,
        ];
    }
}

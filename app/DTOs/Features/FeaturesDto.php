<?php

namespace App\DTOs\Features;

use DateTimeInterface;

class FeaturesDto
{
    public function __construct(
        public readonly ?int $id,
        public readonly ?string $name
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}

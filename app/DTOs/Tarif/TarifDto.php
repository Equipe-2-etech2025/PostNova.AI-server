<?php

namespace App\DTOs\Tarif;

class TarifDto
{
    public function __construct(
        public readonly ?float $price,
        public readonly ?string $description,
    ) {}

    public function toArray(): array
    {
        return [
            'price' => $this->price,
            'description' => $this->description,
        ];
    }
}

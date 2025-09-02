<?php

namespace App\DTOs\Tarif;

class TarifDto
{
    public function __construct(
        public readonly ?int $id,
        public readonly ?string $name,
        public readonly ?float $amount,
        public readonly ?int $max_limit,
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'amount' => $this->amount,
            'max_limit' => $this->max_limit,
        ];
    }
}

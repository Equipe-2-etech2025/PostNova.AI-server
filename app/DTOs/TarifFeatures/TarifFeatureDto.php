<?php

namespace App\DTOs\TarifFeatures;

class TarifFeatureDto
{
    public function __construct(
        public readonly ?int $id,
        public readonly ?int $tarifId,
        public readonly ?string $name,
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'tarif_id' => $this->tarifId,
            'name' => $this->name,
        ];
    }
}

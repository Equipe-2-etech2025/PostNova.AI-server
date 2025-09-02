<?php

namespace App\DTOs\TypeCampaign;

class TypeCampaignDto
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

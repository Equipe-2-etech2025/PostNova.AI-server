<?php

namespace App\DTOs\TypeCampaign;

use DateTimeInterface;

;

class TypeCampaignDto
{
    public function __construct(
        public readonly ?int $id,
        public readonly ?string $name,
        public readonly ?DateTimeInterface $createdAt,
        public readonly ?DateTimeInterface $updatedAt,
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => $this->createdAt?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updatedAt?->format('Y-m-d H:i:s'),

        ];
    }
}

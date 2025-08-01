<?php

namespace App\DTOs\TypeCampaign;;

class TypeCampaignDto
{
    public function __construct(
        public readonly ?string $label,
        public readonly ?string $description,
    ) {}

    public function toArray(): array
    {
        return [
            'label' => $this->label,
            'description' => $this->description,
        ];
    }
}

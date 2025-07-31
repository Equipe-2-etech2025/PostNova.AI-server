<?php

namespace App\DTOs\TarifUser;

class TarifUserDto
{
    public function __construct(
        public readonly ?int $tarif_id,
        public readonly ?int $user_id,
    ) {}

    public function toArray(): array
    {
        return [
            'tarif_id' => $this->tarif_id,
            'user_id' => $this->user_id,
        ];
    }
}

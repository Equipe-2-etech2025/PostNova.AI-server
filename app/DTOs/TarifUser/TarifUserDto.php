<?php

namespace App\DTOs\TarifUser;

use App\Models\Tarif;

class TarifUserDto
{
    public function __construct(
        public readonly ?int $id,
        public readonly ?int $tarif_id,
        public readonly ?int $user_id,
        public readonly ?\DateTime $expired_at
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'tarif_id' => $this->tarif_id,
            'user_id' => $this->user_id,
            'expired_at' => $this->expired_at,
        ];
    }
}

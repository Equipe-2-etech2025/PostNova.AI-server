<?php

namespace App\DTOs\TarifUser;

class TarifUserDto
{
    public function __construct(
        public readonly ?int $id,
        public readonly ?int $tarif_id,
        public readonly ?int $user_id,
        public readonly ?\DateTimeInterface $created_at = null,
        public readonly ?\DateTimeInterface $expired_at = null
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'tarif_id' => $this->tarif_id,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'expired_at' => $this->expired_at,
        ];
    }
}

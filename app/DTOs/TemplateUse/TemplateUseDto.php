<?php

namespace App\DTOs\TemplateUse;

class TemplateUseDto
{
    public function __construct(
        public readonly ?int $id,
        public readonly ?int $template_id,
        public readonly ?int $user_id,
        public readonly ?\DateTimeInterface $used_at = null
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'template_id' => $this->template_id,
            'user_id' => $this->user_id,
            'used_at' => $this->used_at,
        ];
    }
}

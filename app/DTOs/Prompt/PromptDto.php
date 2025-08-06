<?php

namespace App\DTOs\Prompt;

use DateTimeInterface;

class PromptDto
{
    public function __construct(
        public readonly ?int $id,
        public readonly ?string $content,
        public readonly ?int $campaign_id,
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            'campaign_id' => $this->campaign_id,
        ];
    }
}

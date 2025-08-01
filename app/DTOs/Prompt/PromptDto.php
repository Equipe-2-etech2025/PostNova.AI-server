<?php

namespace App\DTOs\Prompt;

class PromptDto
{
    public function __construct(
        public readonly ?string $content,
        public readonly ?int $campaign_id,
    ) {}

    public function toArray(): array
    {
        return [
            'content' => $this->content,
            'campaign_id' => $this->campaign_id,
        ];
    }
}

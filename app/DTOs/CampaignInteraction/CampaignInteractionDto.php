<?php

namespace App\DTOs\CampaignInteraction;

class CampaignInteractionDto
{
    public function __construct(
        public readonly ?int $id,
        public readonly ?int $user_id,
        public readonly ?int $campaign_id,
        public readonly ?int $views,
        public readonly ?int $likes,
        public readonly ?int $shares,
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'campaign_id' => $this->campaign_id,
            'views' => $this->views,
            'likes' => $this->likes,
            'shares' => $this->shares,
        ], fn ($v) => ! is_null($v));
    }

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            user_id: $data['user_id'] ?? null,
            campaign_id: $data['campaign_id'] ?? null,
            views: $data['views'] ?? null,
            likes: $data['likes'] ?? null,
            shares: $data['shares'] ?? null,
        );
    }
}

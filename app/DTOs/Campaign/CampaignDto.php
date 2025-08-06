<?php
namespace App\DTOs\Campaign;

use DateTimeInterface;

class CampaignDto
{
    public function __construct(
        public readonly ?int $id,
        public readonly ?string $name,
        public readonly ?string $description,
        public readonly ?int $type_campaign_id,
        public readonly ?int $user_id,
        public readonly ?int $status,
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'type_campaign_id' => $this->type_campaign_id,
            'user_id' => $this->user_id,
            'status' => $this->status,
        ], fn($v) => !is_null($v));
    }
}



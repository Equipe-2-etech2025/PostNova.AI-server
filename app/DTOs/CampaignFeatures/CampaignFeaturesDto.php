<?php

namespace App\DTOs\CampaignFeatures;

class CampaignFeaturesDto
{
    public function __construct(
        public readonly ?int $id,
        public readonly ?int $campaign_id,
        public readonly ?int $feature_id,
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'campaign_id' => $this->campaign_id,
            'feature_id' => $this->feature_id,
        ];
    }
}



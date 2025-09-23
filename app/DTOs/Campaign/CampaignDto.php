<?php

namespace App\DTOs\Campaign;

class CampaignDto
{
    public function __construct(
        public readonly ?int $id,
        public readonly ?string $name,
        public readonly ?string $description,
        public readonly ?int $type_campaign_id,
        public readonly ?int $user_id,
        public readonly ?int $status,
        public readonly ?bool $is_published,
        public readonly ?string $business_name,
        public readonly ?string $email,
        public readonly ?string $phone_numbers,
        public readonly ?string $company,
        public readonly ?string $website,
        public readonly ?string $industry,
        public readonly ?string $location,
        public readonly ?string $target_audience,
        public readonly ?string $goals,
        public readonly ?string $budget,
        public readonly ?string $keywords,
        public readonly ?string $additional_notes,
        public readonly ?string $preferred_style
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
            'is_published' => $this->is_published,
            'business_name' => $this->business_name,
            'email' => $this->email,
            'phone_numbers' => $this->phone_numbers,
            'company' => $this->company,
            'website' => $this->website,
            'industry' => $this->industry,
            'location' => $this->location,
            'target_audience' => $this->target_audience,
            'goals' => $this->goals,
            'budget' => $this->budget,
            'keywords' => $this->keywords,
            'additional_notes' => $this->additional_notes,
            'preferred_style' => $this->preferred_style,
        ], fn ($v) => ! is_null($v));
    }
}

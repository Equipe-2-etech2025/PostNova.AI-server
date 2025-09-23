<?php

namespace App\DTOs\Prompt;

class PromptDto
{
    public function __construct(
        public ?int $id,
        public ?string $content,
        public ?int $campaign_id,
        public ?string $business_name,
        public ?string $email,
        public ?array $phone_numbers,
        public ?string $company,
        public ?string $website,
        public ?string $industry,
        public ?string $location,
        public ?string $target_audience,
        public ?string $goals,
        public ?string $budget,
        public ?array $keywords,
        public ?string $preferred_style,
        public ?string $additional_notes
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            'campaign_id' => $this->campaign_id,
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
            'preferred_style' => $this->preferred_style,
            'additional_notes' => $this->additional_notes,
        ];
    }
}

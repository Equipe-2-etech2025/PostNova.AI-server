<?php

namespace App\DTOs\CampaignTemplate;

class CampaignTemplateDto
{
    public function __construct(
        public ?int $id,
        public string $name,
        public ?string $description,
        public ?string $category,
        public ?int $type_campaign_id,
        public ?string $author,
        public ?string $thumbnail,
        public ?string $preview,
        public bool $is_premium,
        public float $rating = 0,
        public int $uses = 0,
        public ?string $created_at = null,
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'category' => $this->category,
            'type_campaign_id' => $this->type_campaign_id,
            'author' => $this->author,
            'thumbnail' => $this->thumbnail,
            'preview' => $this->preview,
            'is_premium' => $this->is_premium,
            'rating' => $this->rating,
            'uses' => $this->uses,
            'created_at' => $this->created_at,
        ];
    }
}

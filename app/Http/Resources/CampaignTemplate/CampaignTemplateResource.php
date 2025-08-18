<?php

namespace App\Http\Resources\CampaignTemplate;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property \App\Models\CampaignTemplate $resource
 */
class CampaignTemplateResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'description' => $this->resource->description,
            'category' => $this->resource->category ? [
                'id' => $this->resource->category->id,
                'name' => $this->resource->category->name,
                'icon' => $this->resource->category->icon,
            ] : null,
            'type' => $this->resource->typeCampaign ? [
                'id' => $this->resource->typeCampaign->id,
                'name' => $this->resource->typeCampaign->name,
            ] : null,
            'author' => $this->resource->author,
            'thumbnail' => $this->resource->thumbnail,
            'preview' => $this->resource->preview,
            'isPremium' => (bool) $this->resource->is_premium,
            'rating' => round($this->resource->ratings_avg_rating ?? 0, 1),
            'uses' => $this->resource->uses_count ?? 0,
            'tags' => $this->resource->tags->pluck('tag'),
            'createdAt' => optional($this->resource->created_at)->format('Y-m-d'),
        ];
    }
}

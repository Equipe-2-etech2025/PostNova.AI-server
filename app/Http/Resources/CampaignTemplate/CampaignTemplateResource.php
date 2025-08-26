<?php

namespace App\Http\Resources\CampaignTemplate;

use Illuminate\Http\Resources\Json\JsonResource;

class CampaignTemplateResource extends JsonResource
{
    /**
     * @var \App\Models\CampaignTemplate
     */
    public $resource;

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
            'author' => $this->author,
            'thumbnail' => $this->thumbnail,
            'preview' => $this->preview,
            'isPremium' => (bool) $this->is_premium,
            'rating' => round($this->ratings_avg_rating ?? 0, 1),
            'uses' => $this->uses_count ?? 0,
            'tags' => $this->tags->pluck('tag'),
            
            'socialPosts' => $this->socialPosts->map(function ($post) {
                return [
                    'id' => $post->id,
                    'content' => $post->content,
                    'created_at' => $post->created_at->format('Y-m-d H:i'),
                    'social' => $post->social ? [
                        'id' => $post->social->id,
                        'name' => $post->social->name,
                    ] : null,
                ];
            }),

            'createdAt' => optional($this->created_at)->format('Y-m-d'),
        ];
    }
}

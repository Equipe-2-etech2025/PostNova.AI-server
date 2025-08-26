<?php
namespace App\Http\Resources\CampaignTemplate;

use Illuminate\Http\Resources\Json\JsonResource;

class CampaignTemplateResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'category' => $this->category ? [
                'id' => $this->category->id,
                'name' => $this->category->name,
                'icon' => $this->category->icon,
            ] : null,
            'type' => $this->typeCampaign ? [
                'id' => $this->typeCampaign->id,
                'name' => $this->typeCampaign->name,
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

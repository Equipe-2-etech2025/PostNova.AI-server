<?php

namespace App\Http\Resources\SocialPost;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\SocialPost
 */
class SocialPostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'content' => $this->resource->content,
            'is_published' => $this->resource->is_published,
            'social_id' => $this->resource->social_id,
            'campaign_id' => $this->resource->campaign_id,
            'created_at' => $this->resource->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->resource->updated_at?->format('Y-m-d H:i:s'),
            'social' => $this->whenLoaded('social'),
            'campaign' => $this->whenLoaded('campaign'),
        ];
    }
}

<?php

namespace App\Http\Resources\SocialPost;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'id' => $this->id,
            'content' => $this->content,
            'is_published' => $this->is_published,
            'social_id' => $this->social_id,
            'campaign_id' => $this->campaign_id,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
            'social' => $this->whenLoaded('social'),
            'campaign' => $this->whenLoaded('campaign'),
        ];
    }
}

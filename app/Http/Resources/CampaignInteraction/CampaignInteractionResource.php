<?php

namespace App\Http\Resources\CampaignInteraction;

use Illuminate\Http\Resources\Json\JsonResource;

class CampaignInteractionResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'user_id' => $this->resource->user_id,
            'campaign_id' => $this->resource->campaign_id,
            'views' => $this->resource->views,
            'likes' => $this->resource->likes,
            'shares' => $this->resource->shares,
            'created_at' => $this->resource->created_at?->toIso8601String(),
            'updated_at' => $this->resource->updated_at?->toIso8601String(),
            'links' => [
                'self' => route('api.campaign-interactions.show', $this->resource->id),
                'campaign' => $this->resource->campaign_id ? route('api.campaigns.show', $this->resource->campaign_id) : null,
                'user' => $this->resource->user_id ? route('api.users.show', $this->resource->user_id) : null,
            ],
        ];
    }
}

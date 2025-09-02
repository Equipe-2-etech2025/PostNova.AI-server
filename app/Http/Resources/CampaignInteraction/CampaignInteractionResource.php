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
        ];
    }
}

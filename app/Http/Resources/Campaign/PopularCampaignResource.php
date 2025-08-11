<?php

namespace App\Http\Resources\Campaign;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Campaign
 */
class PopularCampaignResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'description' => $this->resource->description,
            'type_campaign_id' => $this->resource->type_campaign_id,
            'image_path' => $this->resource->image_path,
            'total_views' => $this->resource->total_views,
            'total_likes' => $this->resource->total_likes,
        ];
    }
}

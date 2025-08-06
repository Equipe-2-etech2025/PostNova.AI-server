<?php

namespace App\Http\Resources\Campaign;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PopularCampaignResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'type_campaign_id' => $this->type_campaign_id,
            'image_path' => $this->image_path,
            'total_views' => $this->total_views,
            'total_likes' => $this->total_likes,
        ];
    }
}

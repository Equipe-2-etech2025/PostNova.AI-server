<?php

namespace App\Http\Resources\Campaign;

use App\Enums\StatusEnum;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Campaign
 */
class CampaignResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'user_id' => $this->resource->user_id,
            'type_campaign_id'=>$this->resource->type_campaign_id,
            'status' => [
                'value' => $this->resource->status,
                'label' => StatusEnum::from($this->resource->status)->label(),
            ],
            'description' => $this->resource->description,

            'user' => $this->whenLoaded('user', function () {
                return $this->resource->user ? [
                    'id' => $this->resource->user->id,
                    'name' => $this->resource->user->name,
                ] : null;
            }),

            'type' => $this->whenLoaded('typeCampaign', function () {
                return $this->resource->typeCampaign ? [
                    'id' => $this->resource->typeCampaign->id,
                    'name' => $this->resource->typeCampaign->name,
                ] : null;
            }),

            'dates' => [
                'created_at' => $this->resource->created_at ? $this->created_at->format('Y-m-d H:i') : null,
                'updated_at' => $this->resource->updated_at ? $this->updated_at->format('Y-m-d H:i') : null,
            ],

            'images_count' => $this->resource->images_count ?? 0,
            'landing_pages_count' => $this->resource->landing_pages_count ?? 0,
            'social_posts_count' => $this->resource->social_posts_count ?? 0,

            'total_views' => $this->resource->total_views ?? 0,
            'total_likes' => $this->resource->total_likes ?? 0,
            'total_shares' => $this->resource->total_shares ?? 0,
        ];
    }
}

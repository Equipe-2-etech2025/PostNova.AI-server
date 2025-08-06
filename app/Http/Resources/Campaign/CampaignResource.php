<?php

namespace App\Http\Resources\Campaign;

use App\Enums\StatusEnum;
use Illuminate\Http\Resources\Json\JsonResource;

class CampaignResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'status' => [
                'value' => $this->status,
                'label' => StatusEnum::from($this->status)->label(),
            ],
            'description' => $this->description,
    
            'user' => $this->whenLoaded('user', function () {
                return $this->user ? [
                    'id' => $this->user->id,
                    'name' => $this->user->name,
                ] : null;
            }),
    
            'type' => $this->whenLoaded('typeCampaign', function () {
                return $this->typeCampaign ? [
                    'id' => $this->typeCampaign->id,
                    'name' => $this->typeCampaign->name,
                ] : null;
            }),
    
            'dates' => [
                'created_at' => $this->created_at ? $this->created_at->format('Y-m-d H:i') : null,
                'updated_at' => $this->updated_at ? $this->updated_at->format('Y-m-d H:i') : null,
            ],
    
            'images_count' => $this->images_count ?? 0,
            'landing_pages_count' => $this->landing_pages_count ?? 0,
            'social_posts_count' => $this->social_posts_count ?? 0,
    
            'total_views' => $this->total_views ?? 0,
            'total_likes' => $this->total_likes ?? 0,
            'total_shares' => $this->total_shares ?? 0,
        ];
    }    
}

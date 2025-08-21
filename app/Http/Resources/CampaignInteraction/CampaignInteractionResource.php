<?php

namespace App\Http\Resources\CampaignInteraction;

use App\Models\CampaignInteraction;
use Illuminate\Http\Resources\Json\JsonResource;

class CampaignInteractionResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'campaign_id' => $this->campaign_id,
            'views' => $this->views,
            'likes' => $this->likes,
            'shares' => $this->shares,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
            'links' => [
                'self' => route('api.campaign-interactions.show', $this->id),
                'campaign' => $this->campaign_id ? route('api.campaigns.show', $this->campaign_id) : null,
                'user' => $this->user_id ? route('api.users.show', $this->user_id) : null,
            ],
        ];
    }
}

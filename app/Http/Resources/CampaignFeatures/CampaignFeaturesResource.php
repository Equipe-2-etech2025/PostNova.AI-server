<?php

namespace App\Http\Resources\CampaignFeatures;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\CampaignFeatures
 */
class CampaignFeaturesResource extends JsonResource
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
            'campaign_id' => $this->resource->campaign_id,
            'feature_id' => $this->resource->feature_id,
        ];
    }
}

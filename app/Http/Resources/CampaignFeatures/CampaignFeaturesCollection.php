<?php

namespace App\Http\Resources\CampaignFeatures;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CampaignFeaturesCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => CampaignFeaturesResource::collection($this->collection),
        ];
    }
}

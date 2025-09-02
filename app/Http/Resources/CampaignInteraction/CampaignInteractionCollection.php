<?php

namespace App\Http\Resources\CampaignInteraction;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CampaignInteractionCollection extends ResourceCollection
{
    public $collects = CampaignInteractionResource::class;

    public function toArray($request): array
    {
        return [
            'data' => $this->collection,
            'meta' => [
                'total_interactions' => $this->count(),
                'total_views' => $this->collection->sum('views'),
                'total_likes' => $this->collection->sum('likes'),
                'total_shares' => $this->collection->sum('shares'),
            ],
        ];
    }
}

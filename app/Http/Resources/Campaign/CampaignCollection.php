<?php

namespace App\Http\Resources\Campaign;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CampaignCollection extends ResourceCollection
{
    public $collects = CampaignResource::class;

    public function toArray($request): array
    {
        return [
            'data' => CampaignResource::collection($this->collection),
            'meta' => [
                'total' => $this->count(),
            ],
        ];
    }
}

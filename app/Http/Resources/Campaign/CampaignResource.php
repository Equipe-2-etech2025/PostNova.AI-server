<?php

namespace App\Http\Resources\Campaign;

use Illuminate\Http\Resources\Json\JsonResource;

class CampaignResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'status' => $this->status,
            'description' => $this->description,
            'user' => $this->whenLoaded('user', [
                'id' => $this->user->id,
                'name' => $this->user->name
            ]),
            'type' => $this->whenLoaded('typeCampaign', [
                'id' => $this->typeCampaign->id,
                'name' => $this->typeCampaign->name
            ]),
            'dates' => [
                'created_at' => $this->created_at->format('Y-m-d H:i'),
                'updated_at' => $this->updated_at->format('Y-m-d H:i'),
            ],
            'links' => [
                'self' => route('campaigns.show', $this->id),
            ]
        ];
    }
}

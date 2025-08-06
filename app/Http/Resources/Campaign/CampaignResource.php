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
        ];
    }
}

<?php

namespace App\Http\Resources\TarifUser;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\TypeCampaign
 */
class TarifUserResource extends JsonResource
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
            'tarif_id' => $this->resource->tarif_id,
            'user_id' => $this->resource->user_id,
            'created_at' => $this->resource->created_at?->format('Y-m-d H:i'),
            'expired_at' => $this->resource->expired_at?->format('Y-m-d H:i'),
            'tarif' => [
                'id' => $this->resource->tarif->id,
                'name' => $this->resource->tarif->name,
                'max_limit' => $this->resource->tarif->max_limit,
                'amount' => $this->resource->tarif->amount,
            ],
        ];
    }
}

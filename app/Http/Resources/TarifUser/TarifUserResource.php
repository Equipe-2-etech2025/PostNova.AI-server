<?php

namespace App\Http\Resources\TarifUser;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'id' => $this->id,
            'tarif_id' => $this->tarif_id,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at?->format('Y-m-d H:i'),
            'tarif' => [
                'id' => $this->tarif->id,
                'name' => $this->tarif->name,
                'max_limit' => $this->tarif->max_limit,
                'amount' => $this->tarif->amount,
            ],
        ];
    }
}

<?php

namespace App\Http\Resources\TarifFeature;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\TarifFeature
 */
class TarifFeatureResource extends JsonResource
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
            'name' => $this->resource->name,
            'created_at' => $this->resource->created_at ? $this->created_at->format('Y-m-d H:i') : null,
            'updated_at' => $this->resource->created_at ? $this->created_at->format('Y-m-d H:i') : null,
        ];
    }
}

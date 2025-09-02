<?php

namespace App\Http\Resources\Image;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Image
 */
class ImageResource extends JsonResource
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
            'path' => $this->resource->path,
            'is_published' => $this->resource->is_published,
            'campaign_id' => $this->resource->campaign_id,
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
            'prompt' => $this->resource->prompt ? $this->resource->prompt->content : null,
        ];
    }
}

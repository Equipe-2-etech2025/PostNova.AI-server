<?php

namespace App\Http\Resources\LandingPage;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LandingPageResource extends JsonResource
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
            'content' =>$this->content,
            'path' => $this->path,
            'is_published' => $this->is_published,
            'campaign_id' => $this->campaign_id,
            'created_at' =>  $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' =>  $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}

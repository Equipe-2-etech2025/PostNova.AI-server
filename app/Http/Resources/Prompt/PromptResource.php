<?php

namespace App\Http\Resources\Prompt;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PromptResource extends JsonResource
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
            'content' => $this->content,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' =>  $this->updated_at?->format('Y-m-d H:i:s'),
            'campaign_id' => (int)$this->campaign_id,
        ];
    }
}

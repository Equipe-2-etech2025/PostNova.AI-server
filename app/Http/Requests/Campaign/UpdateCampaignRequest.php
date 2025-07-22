<?php

namespace App\Http\Requests\Campaign;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCampaignRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->campaign);
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'status' => 'sometimes|string|in:draft,published,archived',
            'description' => 'nullable|string',
            'type_campaign_id' => 'sometimes|exists:type_campaigns,id',
        ];
    }
}

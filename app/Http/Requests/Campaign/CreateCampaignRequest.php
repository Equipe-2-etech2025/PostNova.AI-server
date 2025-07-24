<?php

namespace App\Http\Requests\Campaign;

use Illuminate\Foundation\Http\FormRequest;

class CreateCampaignRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'status' => ['nullable', 'in:pending,processing,completed,failed'],
            'description' => 'nullable|string',
            'type_campaign_id' => 'required|exists:type_campaigns,id',
        ];
    }

    public function messages(): array
    {
        return [
            'type_campaign_id.exists' => 'Le type de campagne sélectionné est invalide.',
        ];
    }
}

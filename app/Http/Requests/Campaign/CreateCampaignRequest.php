<?php

namespace App\Http\Requests\Campaign;

use Illuminate\Foundation\Http\FormRequest;

class CreateCampaignRequest extends FormRequest
{
    public function authorize(): bool
    {
        // ou `return auth()->user()->isAdmin();`
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'status' => 'required|string|in:draft,published,archived',
            'description' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
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

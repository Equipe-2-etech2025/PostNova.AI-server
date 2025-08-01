<?php

namespace App\Http\Requests\CampaignFeatures;

use App\DTOs\CampaignFeatures\CampaignFeaturesDto;
use Illuminate\Foundation\Http\FormRequest;

class CreateCampaignFeaturesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'campaign_id' => ['required', 'integer', 'exists:campaigns,id'],
            'feature_id' => ['required', 'integer', 'exists:features,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'campaign_id.required' => 'Le champ campaign_id est requis.',
            'campaign_id.integer' => 'Le champ campaign_id doit être un entier.',
            'campaign_id.exists' => 'La campagne spécifiée est introuvable.',
            'feature_id.required' => 'Le champ feature_id est requis.',
            'feature_id.integer' => 'Le champ feature_id doit être un entier.',
            'feature_id.exists' => 'La fonctionnalité spécifiée est introuvable.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'campaign_id' => (int) $this->campaign_id,
            'feature_id' => (int) $this->feature_id,
        ]);
    }

    public function toDto(): CampaignFeaturesDto
    {
        return new CampaignFeaturesDto(
            campaign_id: $this->input('campaign_id'),
            feature_id: $this->input('feature_id')
        );
    }
}

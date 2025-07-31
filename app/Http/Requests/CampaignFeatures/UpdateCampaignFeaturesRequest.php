<?php

namespace App\Http\Requests\CampaignFeatures;

use App\DTOs\CampaignFeatures\CampaignFeaturesDto;
use App\Models\CampaignFeatures;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCampaignFeaturesRequest extends FormRequest
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
            'campaign_id' => ['sometimes', 'integer', 'exists:campaigns,id'],
            'feature_id' => ['sometimes', 'integer', 'exists:features,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'campaign_id.integer' => 'Le champ campaign_id doit être un entier.',
            'campaign_id.exists' => 'La campagne spécifiée est introuvable.',
            'feature_id.integer' => 'Le champ feature_id doit être un entier.',
            'feature_id.exists' => 'La fonctionnalité spécifiée est introuvable.',
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('campaign_id')) {
            $this->merge(['campaign_id' => (int) $this->campaign_id]);
        }
        if ($this->has('feature_id')) {
            $this->merge(['feature_id' => (int) $this->feature_id]);
        }
    }

    public function toDto(?CampaignFeatures $campaignFeatures = null ): CampaignFeaturesDto
    {
        return new CampaignFeaturesDto(
            campaign_id: $this->input('campaign_id', $campaignFeatures?->campaign_id ?? null),
            feature_id: $this->input('feature_id',  $campaignFeatures?->feature_id ?? null),
        );
    }
}

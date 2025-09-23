<?php

namespace App\Http\Requests\Campaign;

use App\DTOs\Campaign\CampaignDto;
use App\Enums\StatusEnum;
use App\Models\Campaign;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCampaignRequest extends FormRequest
{
    public function authorize(): bool
    {
        if (!$this->user()) {
            return false;
        }

        $campaignId = $this->route('campaign') ?? $this->route('id');
        
        if (!$campaignId) {
            return false;
        }

        $campaign = Campaign::find($campaignId);
        
        if (!$campaign) {
            return false;
        }
        
        return $campaign->user_id === $this->user()->id;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'status' => ['sometimes', Rule::in(StatusEnum::values())],
            'description' => 'sometimes|string|max:1000',
            'type_campaign_id' => 'sometimes|integer|exists:type_campaigns,id',
            'is_published' => 'sometimes|boolean',
            'business_name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255',
            'phone_numbers' => 'sometimes|array',
            'phone_numbers.*' => 'string|max:20',
            'company' => 'sometimes|string|max:255',
            'website' => 'sometimes|string|max:255',
            'industry' => 'sometimes|string|max:255',
            'location' => 'sometimes|string|max:255',
            'target_audience' => 'sometimes|string|max:255',
            'goals' => 'sometimes|string|max:1000',
            'budget' => 'sometimes|string|max:255',
            'keywords' => 'sometimes|array',
            'keywords.*' => 'string|max:100',
            'additional_notes' => 'sometimes|string|max:1000',
            'preferred_style' => 'sometimes|string|max:255',
        ];
    }

    /**
     * Messages de validation personnalisés
     */
    public function messages(): array
    {
        return [
            'description.max' => 'La description ne peut pas dépasser 1000 caractères.',
            'type_campaign_id.exists' => 'Type de campaign invalide.',
        ];
    }

    /**
     * Préparation des données avant validation
     */
    protected function prepareForValidation(): void
    {
        if ($this->has('name')) {
            $this->merge([
                'name' => trim($this->name),
            ]);
        }

        if ($this->has('description')) {
            $this->merge([
                'description' => trim($this->description),
            ]);
        }
    }

    public function toDto(?Campaign $campaign = null): CampaignDto
    {
        if (!$campaign) {
            $campaignId = $this->route('campaign') ?? $this->route('id');
            $campaign = Campaign::findOrFail($campaignId);
        }

        return new CampaignDto(
            $campaign->id,
            name: $this->input('name', $campaign->name),
            description: $this->input('description', $campaign->description),
            type_campaign_id: $this->input('type_campaign_id', $campaign->type_campaign_id),
            user_id: $campaign->user_id,
            status: $this->input('status', $campaign->status ?? StatusEnum::Created->value),
            is_published: $this->input('is_published', $campaign->is_published ?? false),
            business_name: $this->input('business_name', $campaign->business_name),
            email: $this->input('email', $campaign->email),
            phone_numbers: $this->input('phone_numbers', $campaign->phone_numbers),
            company: $this->input('company', $campaign->company),
            website: $this->input('website', $campaign->website),
            industry: $this->input('industry', $campaign->industry),
            location: $this->input('location', $campaign->location),
            target_audience: $this->input('target_audience', $campaign->target_audience),
            goals: $this->input('goals', $campaign->goals),
            budget: $this->input('budget', $campaign->budget),
            keywords: $this->input('keywords', $campaign->keywords),
            additional_notes: $this->input('additional_notes', $campaign->additional_notes),
            preferred_style: $this->input('preferred_style', $campaign->preferred_style),
        );
    }
}

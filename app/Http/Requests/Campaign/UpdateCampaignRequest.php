<?php

namespace App\Http\Requests\Campaign;

use App\DTOs\Campaign\CampaignDto;
use App\Enums\StatusEnum;
use App\Models\Campaign;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCampaignRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à faire cette requête.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Règles de validation pour la mise à jour d'une campagne
     */
    public function rules(): array
    {
        $campaignId = $this->route('campaign');

        return [
            'name' => [
                'sometimes',
                'string',
                'max:255',
            ],
            'status' => ['sometimes', Rule::in(StatusEnum::values())],
            'description' => 'sometimes|string|max:1000',
            'user_id' => 'sometimes|integer|exists:users,id',
            'type_campaign_id' => [
                'sometimes',
                'integer',
                'exists:type_campaigns,id',
            ],
            'is_published' => ['sometimes', 'boolean'],
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
        return new CampaignDto(
            null,
            name: $this->input('name', $campaign->name),
            description: $this->input('description', $campaign->description),
            type_campaign_id: $this->input('type_campaign_id', $campaign->type_campaign_id),
            user_id: $this->input('user_id', $campaign->user_id),
            status: $this->input('status', $campaign->status ?? StatusEnum::Created->value),
            is_published: $this->input('is_published', $campaign->is_published ?? false)
        );
    }
}

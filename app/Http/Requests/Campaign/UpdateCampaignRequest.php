<?php

namespace App\Http\Requests\Campaign;

use App\DTOs\Campaign\CampaignDto;
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
        return [
            'name' => [
                'sometimes',
                'string',
                'max:255',
                Rule::unique('campaigns')->ignore($this->route('campaign'))
            ],
            'description' => 'sometimes|string|max:1000',
            'user_id' => 'sometimes|integer|exists:users,id',
            'type_campaign_id' => [
                'sometimes',
                'integer',
                'exists:type_campaigns,id'
            ]
        ];
    }

    /**
     * Messages de validation personnalisés
     */
    public function messages(): array
    {
        return [
            'name.unique' => 'Ce nom de campagne est déjà utilisé',
            'name.required' => 'Le nom de la campaign est obligatoire.',
            'description.required' => 'La description de la campaign est obligatoire.',
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
                'description'
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
            name: $this->input('name', $campaign?->name ?? null),
            description: $this->input('description', $campaign?->description ?? null),
            type_campaign_id: $this->input('type_campaign_id', $campaign?->type_campaign_id ?? null),
            user_id: $this->input('user_id', $campaign?->user_id ?? null),
            status: $this->input('status', $campaign?->status ?? 'processing')
        );
    }


}

<?php

namespace App\Http\Requests\Campaign;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCampaignRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à faire cette requête.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('campaign'));
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
            'status' => [
                'sometimes',
                'string',
                Rule::in(['draft', 'published', 'archived'])
            ],
            'description' => 'nullable|string|max:1000',
            'type_campaign_id' => [
                'sometimes',
                'integer',
                'exists:type_campaigns,id'
            ],
            'start_date' => [
                'sometimes',
                'date',
                'before_or_equal:end_date'
            ],
            'end_date' => [
                'sometimes',
                'date',
                'after_or_equal:start_date'
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
            'status.in' => 'Le statut doit être parmi : draft, published, archived',
            'type_campaign_id.exists' => 'Le type de campagne sélectionné est invalide',
            'end_date.after_or_equal' => 'La date de fin doit être postérieure ou égale à la date de début'
        ];
    }

    /**
     * Préparation des données avant validation
     */
    protected function prepareForValidation(): void
    {
        if ($this->has('name')) {
            $this->merge([
                'name' => trim($this->name)
            ]);
        }
    }
}

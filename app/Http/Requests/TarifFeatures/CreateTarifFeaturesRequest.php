<?php

namespace App\Http\Requests\TarifFeatures;

use App\DTOs\TarifFeatures\TarifFeatureDto;
use Illuminate\Foundation\Http\FormRequest;

class CreateTarifFeaturesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tarif_id' => ['required', 'integer', 'exists:tarifs,id'],
            'name' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'tarif_id.required' => 'Le champ tarif_id est requis.',
            'tarif_id.integer' => 'Le champ tarif_id doit être un entier.',
            'tarif_id.exists' => 'Le tarif spécifié est introuvable.',

            'name.required' => 'Le nom est requis.',
            'name.string' => 'Le nom doit être une chaîne de caractères.',
            'name.max' => 'Le nom ne peut pas dépasser 255 caractères.',
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('name')) {
            $this->merge([
                'name' => trim($this->input('name')),
            ]);
        }
    }

    public function toDto(): TarifFeatureDto
    {
        return new TarifFeatureDto(
            null,
            tarifId: $this->input('tarif_id'),
            name: $this->input('name')
        );
    }

}

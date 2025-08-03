<?php

namespace App\Http\Requests\Feature;

use App\DTOs\Features\FeaturesDto;
use App\Models\Features;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFeatureRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->role === 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => [
                'sometimes',
                'string',
                'max:100',
                Rule::unique('features')->ignore($this->route('id') ?? $this->feature?->id),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le nom de la fonctionnalité est obligatoire.',
            'name.max' => 'Le nom ne peut pas dépasser 100 caractères.',
            'name.unique' => 'Ce nom de fonctionnalité est déjà utilisé.',
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('name')) {
            $this->merge([
                'name' => trim($this->name),
            ]);
        }
    }

    public function toDto(?Features $features = null): FeaturesDto
    {
        return new FeaturesDto(
            name: $this->input('name', $features?->name ?? null),
        );
    }

}

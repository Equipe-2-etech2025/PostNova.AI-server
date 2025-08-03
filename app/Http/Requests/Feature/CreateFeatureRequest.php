<?php

namespace App\Http\Requests\Feature;

use App\DTOs\Features\FeaturesDto;
use Illuminate\Foundation\Http\FormRequest;

class CreateFeatureRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100|unique:features,name',
        ];
    }

    public function messages(): array {
        return [
            'name.required' => 'Le nom de la fonctionnalité est obligatoire.',
            'name.max' => 'Le nom ne peut pas dépasser 100 caractères.',
            'name.unique' => 'Ce nom de fonctionnalité existe déjà.',
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

    public function toDto(): FeaturesDto
    {
        return new FeaturesDto(
            name: $this->input('name'),
        );
    }

}

<?php

namespace App\Http\Requests\TarifFeatures;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTarifFeaturesRequest extends FormRequest
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
            'name' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le nom est requis.',
            'name.string' => 'Le nom doit être une chaîne de caractères.',
            'name.max' => 'Le nom ne peut pas dépasser 255 caractères.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => ucfirst(strtolower(trim($this->name))),
        ]);
    }

}

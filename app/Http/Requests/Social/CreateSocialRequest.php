<?php

namespace App\Http\Requests\Social;

use App\Models\Campaign;
use Illuminate\Foundation\Http\FormRequest;

class CreateSocialRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100|unique:socials,name',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le nom du réseau social est obligatoire.',
            'name.max' => 'Le nom ne peut pas dépasser 100 caractères.',
            'name.unique' => 'Ce nom de réseau social existe déjà.',
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
}

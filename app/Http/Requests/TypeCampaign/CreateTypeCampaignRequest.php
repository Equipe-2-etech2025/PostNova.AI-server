<?php

namespace App\Http\Requests\TypeCampaign;

use App\DTOs\TypeCampaign\TypeCampaignDto;
use Illuminate\Foundation\Http\FormRequest;

class CreateTypeCampaignRequest extends FormRequest
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

    public function toDto(): TypeCampaignDto
    {
        return new TypeCampaignDto(
            null,
            name: $this->input('name'),
            createdAt: $this->input('created_at'),
            updatedAt: $this->input('updated_at'),
        );
    }

}

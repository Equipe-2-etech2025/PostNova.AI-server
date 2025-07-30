<?php

namespace App\Http\Requests\Image;

use Illuminate\Foundation\Http\FormRequest;

class UpdateImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'path' => 'sometimes|required|string|max:255',
            'is_published' => 'sometimes|required|boolean',
            'campaign_id' => 'sometimes|required|integer|exists:campaigns,id',
        ];
    }

    public function messages(): array
    {
        return [
            'path.required' => 'Le chemin de l\'image est requis si fourni.',
            'is_published.required' => 'Le champ publication est requis si fourni.',
            'campaign_id.exists' => 'La campagne sélectionnée est invalide.',
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'path' => trim((string) $this->input('path')),
        ]);
    }
}

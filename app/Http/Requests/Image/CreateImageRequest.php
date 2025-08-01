<?php

namespace App\Http\Requests\Image;

use App\DTOs\Image\ImageDto;
use Illuminate\Foundation\Http\FormRequest;

class CreateImageRequest extends FormRequest
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
            'path' => 'required|string|max:255',
            'campaign_id' => 'required|integer|exists:campaigns,id',
        ];
    }

    public function messages(): array
    {
        return [
            'path.required' => 'Le chemin de l\'image est obligatoire.',
            'campaign_id.required' => 'La campagne est obligatoire.',
            'campaign_id.exists' => 'La campagne sélectionnée est invalide.',
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'path' => trim($this->input('path')),
        ]);
    }

    public function toDto(): ImageDto
    {
        return new ImageDto(
            path: $this->input('path'),
            campaign_id: $this->input('campaign_id'),
        );
    }

}

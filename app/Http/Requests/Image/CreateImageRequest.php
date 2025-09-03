<?php

namespace App\Http\Requests\Image;

use App\DTOs\Image\ImageDto;
use Illuminate\Foundation\Http\FormRequest;

class CreateImageRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à faire cette requête.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Règles de validation.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'path' => 'required|string|max:255',
            'campaign_id' => [
                'required',
                'integer',
                'exists:campaigns,id',
                function ($attribute, $value, $fail) {
                    $user = auth()->user();

                    if (! $user) {
                        return $fail('Vous devez être connecté.');
                    }

                    if ($user->isAdmin()) {
                        return;
                    }

                    if (! $user->campaigns()->where('id', $value)->exists()) {
                        return $fail('La campagne sélectionnée ne vous appartient pas.');
                    }

                    if (! $user->campaigns()->where('id', $value)->exists()) {
                        return $fail('La campagne sélectionnée ne vous appartient pas.');
                    }
                },
            ],
        ];
    }

    /**
     * Messages de validation personnalisés.
     */
    public function messages(): array
    {
        return [
            'path.required' => 'Le chemin de l\'image est obligatoire.',
            'path.string' => 'Le chemin de l\'image doit être une chaîne de caractères.',
            'path.max' => 'Le chemin de l\'image ne doit pas dépasser 255 caractères.',
            'campaign_id.required' => 'La campagne est obligatoire.',
            'campaign_id.integer' => 'L\'ID de la campagne doit être un entier.',
            'campaign_id.exists' => 'La campagne sélectionnée est invalide.',
        ];
    }

    /**
     * Préparation des données avant validation.
     */
    public function prepareForValidation(): void
    {
        $this->merge([
            'path' => trim($this->input('path')),
        ]);
    }

    /**
     * Conversion en DTO.
     */
    public function toDto(): ImageDto
    {
        return new ImageDto(
            null,
            path: $this->input('path'),
            campaign_id: $this->input('campaign_id'),
            prompt_id:  $this->input('prompt_id'),
            is_published:  $this->input('is_published', false)
        );
    }
}

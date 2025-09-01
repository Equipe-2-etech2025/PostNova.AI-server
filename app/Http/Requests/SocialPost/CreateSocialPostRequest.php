<?php

namespace App\Http\Requests\SocialPost;

use App\DTOs\SocialPost\SocialPostDto;
use Illuminate\Foundation\Http\FormRequest;

class CreateSocialPostRequest extends FormRequest
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
            'content' => 'required|string|max:5000',
            'social_id' => 'required|integer|exists:socials,id',
            'campaign_id' => 'required|integer|exists:campaigns,id',
            'prompt_id' => 'required|integer|exists:prompts,id',

        ];
    }

    public function messages(): array
    {
        return [
            'content.required' => 'Le contenu du post est obligatoire.',
            'content.string' => 'Le contenu doit être une chaîne de caractères.',
            'content.max' => 'Le contenu ne doit pas dépasser 5000 caractères.',

            'social_id.required' => 'Le réseau social est obligatoire.',
            'social_id.exists' => 'Le réseau social sélectionné est invalide.',

            'campaign_id.required' => 'La campagne est obligatoire.',
            'campaign_id.exists' => 'La campagne sélectionnée est invalide.',

            'prompt_id.required' => 'Le prompt est obligatoire.',
            'prompt_id.exists' => 'Le prompt sélectionné est invalide.',
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'content' => trim($this->input('content')),
        ]);
    }

    public function toDto(): SocialPostDto
    {
        return new SocialPostDto(
            null,
            content: $this->input('content'),
            campaign_id: $this->input('campaign_id'),
            social_id: $this->input('social_id'),
            prompt_id: $this->input('prompt_id')
        );
    }
}

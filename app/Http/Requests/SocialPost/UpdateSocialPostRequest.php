<?php

namespace App\Http\Requests\SocialPost;

use App\DTOs\SocialPost\SocialPostDto;
use App\Models\SocialPost;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSocialPostRequest extends FormRequest
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
            'content' => 'sometimes|required|string|max:5000',
            'social_id' => 'sometimes|required|integer|exists:socials,id',
            'campaign_id' => 'sometimes|required|integer|exists:campaigns,id',
        ];
    }

    public function messages(): array
    {
        return [
            'content.required' => 'Le contenu du post est obligatoire.',
            'content.string' => 'Le contenu doit être une chaîne de caractères.',
            'content.max' => 'Le contenu ne doit pas dépasser 5000 caractères.',

            'social_id.required' => 'L\'ID du réseau social est obligatoire.',
            'social_id.integer' => 'L\'ID du réseau social doit être un entier.',
            'social_id.exists' => 'Le réseau social sélectionné est invalide.',

            'campaign_id.required' => 'L\'ID de la campagne est obligatoire.',
            'campaign_id.integer' => 'L\'ID de la campagne doit être un entier.',
            'campaign_id.exists' => 'La campagne sélectionnée est invalide.',
        ];
    }

    public function prepareForValidation(): void
    {
        if ($this->has('content')) {
            $this->merge([
                'content' => trim($this->input('content')),
            ]);
        }
    }

    public function toDto(?SocialPost $socialPost = null): SocialPostDto
    {
        return new SocialPostDto(
            null,
            content: $this->input('content', $socialPost->content ?? null),
            campaign_id: $this->input('campaign_id', $socialPost->campaign_id ?? null),
            social_id: $this->input('social_id', $socialPost->social_id ?? null),
            is_published: $this->input('is_published', $socialPost->is_published ?? null),
        );
    }

}

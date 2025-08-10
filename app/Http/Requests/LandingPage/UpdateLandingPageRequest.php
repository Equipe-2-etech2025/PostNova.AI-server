<?php

namespace App\Http\Requests\LandingPage;

use App\DTOs\LandingPage\LandingPageDto;
use App\Models\LandingPage;
use Illuminate\Foundation\Http\FormRequest;

class UpdateLandingPageRequest extends FormRequest
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
            'path' => 'sometimes|string|max:255',
            'content' => 'sometimes|array',
            'is_published' => 'sometimes|boolean',
            'campaign_id' => 'sometimes|exists:campaigns,id',
        ];
    }

    public function messages(): array
    {
        return [
            'path.string' => 'Le chemin doit être une chaîne de caractères.',
            'content.array' => 'Le contenu doit être un tableau JSON.',
            'is_published.boolean' => 'Le champ de publication doit être un booléen.',
            'campaign_id.exists' => 'La campagne spécifiée n\'existe pas.',
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('content') && is_string($this->content)) {
            $this->merge([
                'content' => json_decode($this->content, true),
            ]);
        }
    }

    public function toDto(?LandingPage $landingPage = null): LandingPageDto
    {
        return new LandingPageDto(
            id: $landingPage?->id,
            path: $this->input('path', $landingPage?->path),
            content: $this->input('content', $landingPage?->content) ?? [],
            campaign_id: $this->input('campaign_id', $landingPage?->campaign_id),
            is_published: (bool)$this->input('is_published', $landingPage?->is_published ?? false)
        );
    }

}

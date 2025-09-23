<?php

namespace App\Http\Requests\Prompt;

use App\DTOs\Prompt\PromptDto;
use App\Models\Prompt;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePromptRequest extends FormRequest
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
            'content' => ['sometimes', 'string'],
            'campaign_id' => ['sometimes', 'exists:campaigns,id'],
            'business_name' => ['sometimes', 'string'],
            'email' => ['sometimes', 'string', 'email'],
            'phone_numbers' => ['sometimes', 'array'],
            'phone_numbers.*' => ['string'],
            'company' => ['sometimes', 'string'],
            'website' => ['sometimes', 'string'],
            'industry' => ['sometimes', 'string'],
            'location' => ['sometimes', 'string'],
            'target_audience' => ['sometimes', 'string'],
            'goals' => ['sometimes', 'string'],
            'budget' => ['sometimes', 'string'],
            'keywords' => ['sometimes', 'array'],
            'keywords.*' => ['string'],
            'additional_notes' => ['sometimes', 'string'],
            'preferred_style' => ['sometimes', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'content.string' => 'Le contenu du prompt doit être une chaîne de caractères.',
            'campaign_id.exists' => 'La campagne spécifiée est introuvable.',
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('campaign_id')) {
            $this->merge([
                'campaign_id' => (int) $this->campaign_id,
            ]);
        }
    }

    public function toDto(?Prompt $prompt = null): PromptDto
    {
        return new PromptDto(
            null,
            content: $this->input('content', $prompt->content ?? null),
            campaign_id: $this->input('campaign_id', $prompt->campaign_id ?? null),
            business_name: $this->input('business_name', $prompt->business_name ?? null),
            email: $this->input('email', $prompt->email ?? null),
            phone_numbers: $this->input('phone_numbers', $prompt->phone_numbers ?? null),
            company: $this->input('company', $prompt->company ?? null),
            website: $this->input('website', $prompt->website ?? null),
            industry: $this->input('industry', $prompt->industry ?? null),
            location: $this->input('location', $prompt->location ?? null),
            target_audience: $this->input('target_audience', $prompt->target_audience ?? null),
            goals: $this->input('goals', $prompt->goals ?? null),
            budget: $this->input('budget', $prompt->budget ?? null),
            keywords: $this->input('keywords', $prompt->keywords ?? null),
            additional_notes: $this->input('additional_notes', $prompt->additional_notes ?? null),
            preferred_style: $this->input('preferred_style', $prompt->preferred_style ?? null),
        );
    }
}

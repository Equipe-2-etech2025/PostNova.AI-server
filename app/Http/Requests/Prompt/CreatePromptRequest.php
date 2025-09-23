<?php

namespace App\Http\Requests\Prompt;

use App\DTOs\Prompt\PromptDto;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreatePromptRequest extends FormRequest
{
    public function authorize(): bool
    {
        if (! $this->user()) {
            return false;
        }
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
            'content' => ['required', 'string'],
            'campaign_id' => ['required', 'exists:campaigns,id'],
            'business_name' => ['nullable', 'string'],
            'email' => ['nullable', 'string', 'email'],
            'phone_numbers' => ['nullable', 'array'],
            'phone_numbers.*' => ['string'],
            'company' => ['nullable', 'string'],
            'website' => ['nullable', 'string'],
            'industry' => ['nullable', 'string'],
            'location' => ['nullable', 'string'],
            'target_audience' => ['nullable', 'string'],
            'goals' => ['nullable', 'string'],
            'budget' => ['nullable', 'string'],
            'keywords' => ['nullable', 'array'],
            'keywords.*' => ['string'],
            'additional_notes' => ['nullable', 'string'],
            'preferred_style' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'content.required' => 'Le contenu du prompt est requis.',
            'content.string' => 'Le contenu du prompt doit être une chaîne de caractères.',
            'campaign_id.required' => 'L\'identifiant de la campagne est requis.',
            'campaign_id.exists' => 'La campagne spécifiée est introuvable.'
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

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422)
        );
    }

    public function toDto(): PromptDto
    {
        return new PromptDto(
            null,
            content: $this->input('content'),
            campaign_id: $this->input('campaign_id'),
            business_name: $this->input('business_name'),
            email: $this->input('email'),
            phone_numbers: $this->input('phone_numbers', []),
            company: $this->input('company'),
            website: $this->input('website'),
            industry: $this->input('industry'),
            location: $this->input('location'),
            target_audience: $this->input('target_audience'),
            goals: $this->input('goals'),
            budget: $this->input('budget'),
            keywords: $this->input('keywords', []),
            additional_notes: $this->input('additional_notes'),
            preferred_style: $this->input('preferred_style'),
        );
    }
}

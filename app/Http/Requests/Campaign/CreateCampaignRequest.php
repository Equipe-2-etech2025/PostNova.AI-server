<?php

namespace App\Http\Requests\Campaign;

use App\DTOs\Campaign\CampaignDto;
use App\Enums\StatusEnum;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CreateCampaignRequest extends FormRequest
{
    public function authorize(): bool
    {
        if (!$this->user()) {
            return false;
        }
        
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'status' => ['nullable'],
            'description' => ['required', 'string', 'max:1000'],
            'type_campaign_id' => ['required', 'integer', 'exists:type_campaigns,id'],
            'is_published' => ['boolean'],
            'business_name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255'],
            'phone_numbers' => ['nullable', 'string', 'max:12'],
            // 'phone_numbers.*' => ['string', 'max:20'],
            'company' => ['nullable', 'string', 'max:255'],
            'website' => ['nullable', 'string', 'max:255'],
            'industry' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'target_audience' => ['nullable', 'string', 'max:255'],
            'goals' => ['nullable', 'string', 'max:1000'],
            'budget' => ['nullable', 'string', 'max:255'],
            'keywords' => ['nullable', 'string', 'max:255'],
            // 'keywords.*' => ['string', 'max:100'],
            'additional_notes' => ['nullable', 'string', 'max:1000'],
            'preferred_style' => ['nullable', 'string', 'max:255']
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le nom de la campagne est obligatoire.',
            'description.required' => 'La description de la campagne est obligatoire.',
            'description.max' => 'La description ne peut pas dépasser 1000 caractères.',
            'type_campaign_id.exists' => 'Type de campaign invalide.',
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'name' => trim($this->input('name')),
            'description' => trim($this->input('description')),
        ]);

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

    public function toDto(): CampaignDto
    {
        return new CampaignDto(
            null,
            name: $this->input('name'),
            description: $this->input('description'),
            type_campaign_id: $this->input('type_campaign_id'),
            user_id: $this->user()->id,
            status: $this->input('status', StatusEnum::Created->value),
            is_published: $this->input('is_published') ?? false,
            business_name: $this->input('business_name'),
            email: $this->input('email'),
            phone_numbers: $this->input('phone_numbers'),
            company: $this->input('company'),
            website: $this->input('website'),
            industry: $this->input('industry'),
            location: $this->input('location'),
            target_audience: $this->input('target_audience'),
            goals: $this->input('goals'),
            budget: $this->input('budget'),
            keywords: $this->input('keywords'),
            additional_notes: $this->input('additional_notes'),
            preferred_style: $this->input('preferred_style'),
        );
    }
}

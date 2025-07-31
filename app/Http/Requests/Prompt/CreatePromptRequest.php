<?php

namespace App\Http\Requests\Prompt;

use Illuminate\Foundation\Http\FormRequest;

class CreatePromptRequest extends FormRequest
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
            'content' => ['required', 'string'],
            'campaign_id' => ['required', 'exists:campaigns,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'content.required' => 'Le contenu du prompt est requis.',
            'content.string' => 'Le contenu du prompt doit être une chaîne de caractères.',
            'campaign_id.required' => 'L\'identifiant de la campagne est requis.',
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
}


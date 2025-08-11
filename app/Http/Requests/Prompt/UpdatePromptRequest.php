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
                'campaign_id' => (int)$this->campaign_id,
            ]);
        }
    }

    public function toDto(?Prompt $prompt = null): PromptDto
    {
        return new PromptDto(
            null,
            content: $this->input('content', $prompt->content ?? null),
            campaign_id: $this->input('campaign_id', $prompt->campaign_id ?? null),
        );
    }

}


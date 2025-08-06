<?php

namespace App\Http\Requests\LandingPage;

use App\DTOs\LandingPage\LandingPageDto;
use Illuminate\Foundation\Http\FormRequest;

class CreateLandingPageRequest extends FormRequest
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
            'content' => 'required|array',
            'campaign_id' => 'required|exists:campaigns,id',
        ];
    }

    public function messages(): array
    {
        return [
            'path.required' => 'Le chemin est obligatoire.',
            'content.required' => 'Le contenu est requis.',
            'campaign_id.required' => 'La campagne associée est obligatoire.',
            'campaign_id.exists' => 'La campagne spécifiée n\'existe pas.',
        ];
    }

    protected function prepareForValidation(): void
    {
        if (is_string($this->content)) {
            $this->merge([
                'content' => json_decode($this->content, true),
            ]);
        }
    }

    public function toDto(): LandingPageDto
    {
        return new LandingPageDto(
            null,
            path: $this->input('path'),
            content: $this->input('content'),
            campaign_id: $this->input('campaign_id'),
        );
    }

}


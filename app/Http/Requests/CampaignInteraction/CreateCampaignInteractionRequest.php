<?php

namespace App\Http\Requests\CampaignInteraction;

use App\DTOs\CampaignInteraction\CampaignInteractionDto;
use Illuminate\Foundation\Http\FormRequest;

class CreateCampaignInteractionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'campaign_id' => 'required|exists:campaigns,id',
            'views' => 'sometimes|integer|min:0',
            'likes' => 'sometimes|integer|min:0',
            'shares' => 'sometimes|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'campaign_id.required' => 'La campagne est obligatoire.',
            'campaign_id.exists' => 'La campagne spécifiée n\'existe pas.',
            'views.integer' => 'Les vues doivent être un nombre entier.',
            'likes.integer' => 'Les likes doivent être un nombre entier.',
            'shares.integer' => 'Les partages doivent être un nombre entier.',
            '*.min' => 'La valeur ne peut pas être négative.',
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'views' => $this->input('views', 0),
            'likes' => $this->input('likes', 0),
            'shares' => $this->input('shares', 0),
        ]);
    }

    public function toDto(): CampaignInteractionDto
    {
        return new CampaignInteractionDto(
            null,
            user_id: $this->user()->id,
            campaign_id: $this->input('campaign_id'),
            views: $this->input('views'),
            likes: $this->input('likes'),
            shares: $this->input('shares'),
        );
    }
}

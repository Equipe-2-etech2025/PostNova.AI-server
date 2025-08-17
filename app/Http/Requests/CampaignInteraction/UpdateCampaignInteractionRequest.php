<?php

namespace App\Http\Requests\CampaignInteraction;

use App\DTOs\CampaignInteraction\CampaignInteractionDto;
use App\Models\CampaignInteraction;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCampaignInteractionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'campaign_id' => 'sometimes|exists:campaigns,id',
            'views' => 'sometimes|integer|min:0',
            'likes' => 'sometimes|integer|min:0',
            'shares' => 'sometimes|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'campaign_id.exists' => 'La campagne spécifiée n\'existe pas.',
            '*.integer' => 'La valeur doit être un nombre entier.',
            '*.min' => 'La valeur ne peut pas être négative.',
        ];
    }

    public function toDto(?CampaignInteraction $interaction = null): CampaignInteractionDto
    {
        return new CampaignInteractionDto(
            null,
            user_id: $this->input('user_id', $interaction?->user_id),
            campaign_id: $this->input('campaign_id', $interaction?->campaign_id),
            views: $this->input('views', $interaction?->views),
            likes: $this->input('likes', $interaction?->likes),
            shares: $this->input('shares', $interaction?->shares)
        );
    }
}

<?php

namespace App\Http\Requests\SocialPost;

use Illuminate\Foundation\Http\FormRequest;

class RegenerateSocialPostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'topic' => 'required|string|min:5|max:1000',
            'platform' => 'sometimes|string|in:linkedin,x,tiktok',
            'campaign_id' => 'required|integer|exists:campaigns,id',
            'prompt_id' => 'required|integer|exists:prompts,id',
            'tone' => 'sometimes|string|max:50',
            'language' => 'sometimes|string|max:10|in:fr,en,es,de,it',
            'hashtags' => 'sometimes|string|max:255',
            'target_audience' => 'sometimes|string|max:255',
            'is_published' => 'sometimes|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'topic.required' => 'Le sujet est obligatoire pour la régénération',
            'campaign_id.required' => 'La campagne est obligatoire',
            'campaign_id.exists' => 'La campagne spécifiée n\'existe pas',
            'prompt_id.required' => 'Le prompt est obligatoire',
            'prompt_id.exists' => 'Le prompt spécifié n\'existe pas',
        ];
    }
}

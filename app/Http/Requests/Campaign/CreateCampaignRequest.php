<?php

namespace App\Http\Requests\Campaign;
use Illuminate\Validation\Rule;
use App\DTOs\Campaign\CampaignDto;
use App\Enums\StatusEnum;
use Illuminate\Foundation\Http\FormRequest;

class CreateCampaignRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'status' => ['nullable', Rule::in(StatusEnum::values())],
            'description' => 'required|string|max:1000',
            'type_campaign_id' => 'required|exists:type_campaigns,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le nom de la campaign est obligatoire.',
            'description.required' => 'La description de la campaign kkkkkk est obligatoire.',
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

    public function toDto(): CampaignDto
    {
        return new CampaignDto(
            null,
            name: $this->input('name'),
            description: $this->input('description'),
            type_campaign_id: $this->input('type_campaign_id'),
            user_id: $this->user()->id,
            status: $this->input('status', StatusEnum::Created->value)
        );
    }
}

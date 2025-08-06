<?php

namespace App\Http\Requests\TarifUser;

use App\DTOs\TarifUser\TarifUserDto;
use Illuminate\Foundation\Http\FormRequest;

class CreateTarifUserRequest extends FormRequest
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
            'tarif_id' => ['required', 'integer', 'exists:tarifs,id'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'expired_at' => ['nullable', 'date', 'after_or_equal:today'],
        ];
    }

    public function messages(): array
    {
        return [
            'tarif_id.required' => 'Le tarif est obligatoire.',
            'tarif_id.exists' => 'Le tarif sélectionné est invalide.',
            'user_id.required' => "L'utilisateur est obligatoire.",
            'user_id.exists' => "L'utilisateur sélectionné est invalide.",
            'expired_at.date' => 'La date d’expiration doit être une date valide.',
            'expired_at.after_or_equal' => 'La date d’expiration doit être aujourd’hui ou une date future.',
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('expired_at') && $this->expired_at === '') {
            $this->merge(['expired_at' => null]);
        }
    }

    public function toDto(): TarifUserDto
    {
        return new TarifUserDto(
            null,
            tarif_id: $this->input('tarif_id'),
            user_id: $this->input('user_id'),
        );
    }

}

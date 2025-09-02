<?php

namespace App\Http\Requests\TarifUser;

use App\DTOs\TarifUser\TarifUserDto;
use App\Models\TarifUser;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTarifUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tarif_id' => ['sometimes', 'integer', 'exists:tarifs,id'],
            'expired_at' => ['nullable', 'date', 'after_or_equal:today'],
        ];
    }

    public function messages(): array
    {
        return [
            'tarif_id.exists' => 'Le tarif sélectionné est invalide.',
            'expired_at.date' => 'La date d’expiration doit être une date valide.',
            'expired_at.after_or_equal' => 'La date d’expiration doit être aujourd’hui ou une date future.',
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('expired_at')) {
            if ($this->expired_at === '') {
                $this->merge(['expired_at' => null]);
            } else {
                $this->merge([
                    'expired_at' => \Carbon\Carbon::parse($this->expired_at),
                ]);
            }
        }
    }

    public function toDto(?TarifUser $tarifUser = null): TarifUserDto
    {
        return new TarifUserDto(
            null,
            tarif_id: $this->input('tarif_id', $tarifUser->tarif_id ?? null),
            user_id: $this->input('user_id', $tarifUser->user_id ?? null),
            created_at: $this->input('created_at', $tarifUser->created_at ?? null),
            expired_at: $this->input('expired_at', $tarifUser->expired_at ?? null),
        );
    }
}

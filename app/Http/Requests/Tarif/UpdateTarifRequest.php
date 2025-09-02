<?php

namespace App\Http\Requests\Tarif;

use App\DTOs\Tarif\TarifDto;
use App\Models\Tarif;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTarifRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:10',
            ],
            'amount' => 'required|numeric|min:0|max:14.99',
            'max_limit' => 'required|integer|min:0|max:3',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le nom du tarif est obligatoire.',
            'name.string' => 'Le nom doit être une chaîne de caractères.',
            'name.max' => 'Le nom ne doit pas dépasser 10 caractères.',

            'amount.required' => 'Le montant est obligatoire.',
            'amount.numeric' => 'Le montant doit être un nombre.',
            'amount.min' => 'Le montant doit être au moins 0.',
            'amount.max' => 'Le montant ne peut pas dépasser 14.99.',

            'max_limit.required' => 'La limite maximale est obligatoire.',
            'max_limit.integer' => 'La limite maximale doit être un entier.',
            'max_limit.min' => 'La limite minimale est 0.',
            'max_limit.max' => 'La limite maximale est 3.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => ucfirst(strtolower(trim($this->name))),
            'amount' => str_replace(',', '.', $this->amount),
        ]);
    }

    public function toDto(?Tarif $tarif = null): TarifDto
    {
        return new TarifDto(
            null,
            name: $this->input('name', $tarif->name ?? null),
            amount: $this->input('amount', $tarif->amount ?? null),
            max_limit: $this->input('max_limit', $tarif->max_limit ?? null),
        );
    }
}

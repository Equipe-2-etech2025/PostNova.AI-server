<?php

namespace App\Http\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'amount' => ['required', 'numeric', 'min:1'],
            'currency' => ['nullable', 'string', 'in:Ar'],
            'description' => ['required', 'string', 'max:50'],
            'customer_msisdn' => ['required', 'string', 'regex:/^034|038[0-9]{7}$/'],
            'merchant_msisdn' => ['required', 'string', 'regex:/^034|038[0-9]{7}$/'],
        ];
    }
}

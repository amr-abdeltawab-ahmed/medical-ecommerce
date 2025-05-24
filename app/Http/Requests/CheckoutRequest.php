<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3'],
            'phone' => ['required', 'regex:/^[0-9]{10,15}$/'],
            'address' => ['required', 'string', 'min:10'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please enter your full name.',
            'phone.required' => 'Phone number is required.',
            'phone.regex' => 'Enter a valid phone number (numbers only, 10–15 digits).',
            'address.required' => 'Delivery address is required.',
        ];
    }
}

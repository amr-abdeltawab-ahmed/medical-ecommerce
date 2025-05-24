<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCartItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'quantities' => ['required', 'array'],
            'quantities.*' => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'quantities.required' => 'No quantities provided',
            'quantities.array' => 'Invalid quantity format',
            'quantities.*.required' => 'Quantity is required',
            'quantities.*.integer' => 'Quantity must be a number',
            'quantities.*.min' => 'Quantity must be at least 1',
        ];
    }
} 
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderPlacingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'billing_name' => ['required', 'string', 'max:255'],
            'billing_address' => ['required', 'string', 'max:255'],
            'billing_email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'products' => ['required'],
            'products.*.name' => ['required', 'string'],
            'products.*.price' => ['required', 'numeric', 'min:0'],
            'products.*.id' => ['required', Rule::exists('products', 'id')],
        ];
    }
}
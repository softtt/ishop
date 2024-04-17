<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'cover' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if (!is_string($value) && !(is_object($value) && $value instanceof UploadedFile && $value->isValid() && strpos($value->getMimeType(), 'image/') === 0)) {
                        $fail('The ' . $attribute . ' must be either an image file or a string.');
                    }
                },
            ],
            'name' => 'required|string|max:255',
            'details' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'product_code' => 'required|string|max:255',
            'price' => 'integer|min:0'
        ];
    }
}

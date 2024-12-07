<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DvdRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'disponibility' => 'integer|max_digits:1',
            'price' => 'integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:png,jpg,jpeg',
        ];
    }
}

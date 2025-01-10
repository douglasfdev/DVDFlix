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
        $rules = [
            'title' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'disponibility' => 'integer|max_digits:1',
            'price' => 'integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:png,jpg,jpeg',
            'quantity' => 'required|integer|min:1',
            'point_of_sale_id' => 'required|integer|exists:point_of_sales,id'
        ];

        if ($this->isMethod('PATCH')) {
            $rules['title'] = 'nullable|string|max:255';
            $rules['genre'] = 'nullable|string|max:255';
            $rules['price'] = 'nullable|integer|min:0';
            $rules['quantity'] = 'integer|min:1';
        }

        return $rules;
    }
}

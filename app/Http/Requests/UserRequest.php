<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255',
      'phone' => 'nullable|string|regex:/^\+?[0-9]{10,15}$/'
    ];

    if ($this->isMethod('post')) {
      $rules['password'] = 'required|string|min:8';
    }

    return $rules;
  }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'postal_code' => ['required', 'regex:/^\d{3}[-]\d{4}$/'],
            'address' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'postal_code.required' => '郵便番号が入力されていません',
            'postal_code.regex' => '郵便番号はハイフンを含むXXX-XXXXの形式で入力してください',
            'address.required' => '住所が入力されていません',
        ];
    }
}

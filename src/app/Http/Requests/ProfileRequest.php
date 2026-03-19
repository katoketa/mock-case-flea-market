<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'image' => 'mimes:jpeg,png|extensions:jpeg,png',
            'name' => 'required|max:20',
            'postal_code' => 'required|regex:/^\d{3}[-]\d{4}$/',
            'address' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'image.mimes' => 'jpegまたはpngを選択してください',
            'image.extensions' => 'jpegまたはpngを選択してください',
            'name.required' => '名前が入力されていません',
            'name.max' => '文字数が20文字を超えています',
            'postal_code.required' => '郵便番号が入力されていません',
            'postal_code.regex' => '郵便番号はハイフンを含む8文字で入力してください',
            'address.required' => '住所が入力されていません',
        ];
    }
}

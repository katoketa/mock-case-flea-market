<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required|max:255',
            'image' => 'required|mimes:jpeg,png|extensions:jpeg,png',
            'categories' => 'required',
            'condition' => 'required',
            'price' => 'required|integer|min:0',
        ];
    }

    public function message()
    {
        return [
            'name.required' => '商品名が入力されていません',
            'description.required' => '商品説明が入力されていません',
            'description.max' => '文字数が255文字を超えています',
            'image.required' => '商品画像が選択されていません',
            'image.mimes' => 'jpegまたはpngを選択してください',
            'image.extensions' => 'jpegまたはpngを選択してください',
            'categories.required' => 'カテゴリーを1つ以上選択してください',
            'condition.required' => '商品の状態を選択してください',
            'price.required' => '販売価格が入力されていません',
            'price.integer' => '販売価格は数字で入力してください',
            'price.min' => '販売価格は0円以上にしてください',
        ];
    }
}

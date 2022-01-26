<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BoardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:50',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'タイトルは必須です',
            'title.min' => ':max 文字以内で入力してください',
            'description.required' => '本文は必須です',
        ];
    }
}

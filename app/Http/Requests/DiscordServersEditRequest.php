<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscordServersEditRequest extends FormRequest
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
            'name' => ['required', 'string', 'unique:discord_servers', 'max:255'],
            'url' => ['required', 'url', 'max:255'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'tags.*' => ['string', 'max:255'],
            'description' => ['required', 'string', 'max:65,535'],
        ];
    }
}

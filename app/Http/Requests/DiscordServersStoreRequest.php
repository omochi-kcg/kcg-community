<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscordServersStoreRequest extends FormRequest
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
            'user_id' => ['required', 'integer', 'exists:users'],
            'name' => ['required', 'string', 'unique:discord_servers', 'max:255'],
            'url' => ['required', 'url', 'max:255'],
            'category_id' => ['required', 'integer', 'exists:categories'],
            'tags.*' => ['string', 'max:255'],
            'description' => ['required', 'string', 'max:65,535'],
        ];
    }
}

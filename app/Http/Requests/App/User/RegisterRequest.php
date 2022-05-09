<?php

namespace App\Http\Requests\App\User;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => 'required|max:254|unique:users',
            'password' => 'required|min:8|max:255',
            'last_name_kanji' => 'required|max:255',
            'first_name_kanji' => 'required|max:255',
            'last_name_kana' => 'required|max:255',
            'first_name_kana' => 'required|max:255',
            'phone' => 'nullable',
            'nickname' => 'required|max:255',
            'date_of_birth' => 'nullable',
            'sex' => 'required|check_sex',
            'zip_code' => 'nullable|max:8',
            'city' => 'nullable|max:255',
            'subsequent_address' => 'nullable|max:255',
        ];
    }

    public function messages()
    {
        return [
            'sex.check_sex' => trans('message.check_sex')
        ];
    }
}

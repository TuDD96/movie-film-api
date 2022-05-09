<?php

namespace App\Http\Requests\App\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'type' => 'required',
            'email' => 'sometimes|max:254|unique:users',
            'old_password' => 'required_if:type,1',
            'password' => 'sometimes|min:8|max:255|different:old_password',
            'last_name_kanji' => 'sometimes|max:255',
            'first_name_kanji' => 'sometimes|max:255',
            'last_name_kana' => 'sometimes|max:255',
            'first_name_kana' => 'sometimes|max:255',
            'phone' => 'sometimes',
            'nickname' => 'sometimes|max:255',
            'date_of_birth' => 'sometimes',
            'sex' => 'sometimes|check_sex',
            'zip_code' => 'sometimes|max:8',
            'city' => 'sometimes|max:255',
            'subsequent_address' => 'sometimes|max:255',
        ];
    }

    public function attributes()
    {
        return [
            'password' => trans('passwords.new_password')
        ];
    }

    public function messages()
    {
        return [
            'sex.check_sex' => trans('message.check_sex'),
            'password.different' => trans('passwords.not_same_password'),
            'old_password.required_if' => trans('passwords.old_password_required')
        ];
    }
}

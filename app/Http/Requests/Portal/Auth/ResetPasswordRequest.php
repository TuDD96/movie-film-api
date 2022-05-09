<?php

namespace App\Http\Requests\Portal\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'token' => 'required',
            'password' => 'required|max:255|min:8',
            'password_confirmation' => 'required|max:255|min:8|same:password',
        ];
    }

    public function attributes()
    {
        return [
            'password' => __('labels.login.password'),
            'password_confirmation' => __('labels.change_password.password_confirm'),
        ];
    }

    public function messages()
    {
        return [
            'password_confirmation.same' => trans('message.password_same'),
            'password.min' => '新しいパスワードは、8文字以上にしてください',
            'password_confirmation.min' => '新しいパスワード（確認）は、8文字以上にしてください',
        ];
    }
}

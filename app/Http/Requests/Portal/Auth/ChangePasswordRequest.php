<?php

namespace App\Http\Requests\Portal\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'password_current' => 'required|max:255|min:8',
            'password_new' => 'required|max:255|min:8|same:password_confirmation',
            'password_confirmation' => 'required|max:255|min:8|different:password_current',
        ];
    }

    public function attributes()
    {
        return [
            'password_current' => __('labels.login.password'),
            'password_new' => __('labels.change_password.password_new'),
            'password_confirmation' => __('labels.change_password.password_confirm'),
        ];
    }
}

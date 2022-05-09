<?php

namespace App\Http\Requests\Portal\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required',
            'regex:/^([A-Za-z0-9])+([\w\.\!\#\$\%\&\*\+\-\/\=\?\^\`\{\|\}\~])*([a-zA-Z0-9])+@([a-zA-Z0-9]+\.)+[a-zA-Z0-9]{2,8}$/',
            'password' => 'required|min:8'
        ];
    }

    public function attributes()
    {
        return [
            'email' => __('labels.login.email'),
            'password' => __('labels.login.password')
        ];
    }
}

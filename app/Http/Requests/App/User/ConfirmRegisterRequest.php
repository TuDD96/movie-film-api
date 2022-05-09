<?php

namespace App\Http\Requests\App\User;

use Illuminate\Foundation\Http\FormRequest;

class ConfirmRegisterRequest extends FormRequest
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
            'token' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'token' => 'トークン',
        ];
    }
}

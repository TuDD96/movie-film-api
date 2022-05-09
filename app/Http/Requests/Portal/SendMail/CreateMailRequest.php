<?php

namespace App\Http\Requests\Portal\SendMail;

use Illuminate\Foundation\Http\FormRequest;

class CreateMailRequest extends FormRequest
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
            'title' => 'required|max:255',
            'body' => 'required',
            'email' => [
                'required',
                'regex:/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/',
                'max:254',
                'check_email_valid'
            ]
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'body' => '本文',
            'email' => 'メール',
        ];
    }

    public function messages()
    {
        return [
            'email.check_email_valid' => '選択されたメールは、有効ではありません。'
        ];
    }
}

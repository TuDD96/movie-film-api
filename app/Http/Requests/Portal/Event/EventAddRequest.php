<?php

namespace App\Http\Requests\Portal\Event;

use App\Enums\DBConstant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class EventAddRequest extends FormRequest
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
            'event_image_add' => 'mimes:jpg,png|max:1000',
            'title' => 'required|max:255|unique:events',
            'body' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'event_image_add.mimes' => 'PNG/JPG形式の画像を指定してください。',
            'event_image_add.max' => '1000KB以下の画像を指定してください。',
        ];
    }
}

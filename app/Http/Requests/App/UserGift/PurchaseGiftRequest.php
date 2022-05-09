<?php

namespace App\Http\Requests\App\UserGift;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseGiftRequest extends FormRequest
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
            'gift_id' => 'required',
            'amount' => 'required',
        ];
    }
}

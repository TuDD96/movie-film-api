<?php

namespace App\Http\Requests\Client;

use App\Enums\DBConstant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class StoreBookRequest extends FormRequest
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
            'thumbnail_url' => 'required|mimes:jpg,png|max:5120',
            'ebook_url' => 'required|mimes:pdf'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '漫画のタイトルは、必ず指定してください。',
            'thumbnail_url.required' => 'サムネイル画像は、必ず指定してください。',
            'ebook_url.required' => 'ファイルを選択は、必ず指定してください。',
            'thumbnail_url.mimes' => 'サムネイル画像は、必ず指定してください。',
            'thumbnail_url.max' => 'サムネイル画像 には、5MB以下のファイルを指定してください。',
            'ebook_url.mimes' => 'ファイルを選択は、必ず指定してください。'
        ];
    }
}

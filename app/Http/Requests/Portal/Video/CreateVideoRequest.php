<?php

namespace App\Http\Requests\Portal\Video;

use Illuminate\Foundation\Http\FormRequest;

class CreateVideoRequest extends FormRequest
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
            'video_url' => 'required|mimes:mp4,mov,ogg,qt|max:512000',
            'thumbnail_url' => 'required|mimes:jpg,png|max:5120',
        ];
    }

    public function attributes()
    {
        return [
            'title' => '動画名',
            'thumbnail_url' => 'サムネイル画像',
            'video_url' => '動画',
        ];
    }

    public function messages()
    {
        return [
            'thumbnail_url.mimes' => 'PNG/JPG形式の画像を指定してください。',
            'video_url.mimes' => 'MP4形式の画像を指定してください。',
            'thumbnail_url.max' => 'サムネイル画像 には、5120KB以下のファイルを指定してください。',
            'video_url.max' => '動画には、500MB以下のファイルを指定してください。',
        ];
    }
}

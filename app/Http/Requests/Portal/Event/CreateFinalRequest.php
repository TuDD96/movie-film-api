<?php

namespace App\Http\Requests\Portal\Event;

use Illuminate\Foundation\Http\FormRequest;

class CreateFinalRequest extends FormRequest
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
        $afterSevenDay = now()->parse(request()->start_datetime)->addDays(7)->toDateTimeString();

        $rules = [
            'name' => 'required|max:255',
            'start_datetime' => [
                'required',
                'date',
                'after:entry_end_datetime'
            ],
            'end_datetime' => [
                'required',
                'date',
            ],
        ];

        $requestData = $this->request->all();
        if (isset($requestData['start_datetime'])) {
            $rules['end_datetime'] = [
                'required',
                'date',
                'date_equals:' . $afterSevenDay,
            ];
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'name' => '決勝ブロック名',
            'start_datetime' => '対戦開始日時',
            'end_datetime' => '対戦終了日時',
        ];
    }

    public function messages()
    {
        return [
            'name.max' => '決勝ブロック名は、255文字以下にしてください。',
        ];
    }
}

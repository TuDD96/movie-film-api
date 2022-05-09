<?php

namespace App\Http\Requests\Portal\Event;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CheckPreliminaryDate;

class CreatePreliminaryRequest extends FormRequest
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
        $requestData = $this->request->all();
        $eventId = $requestData['event_id'];
        return [
            'name' => 'required|max:255',
            'entry_fee' => 'bail|required|integer|min:0|digits_between:1,15',
            'fixed_num' => 'bail|required|max:2147483647|integer|min:1',
            'entry_start_datetime' => [
                'required',
                'date',
                'validate_time',
                // new CheckPreliminaryDate($eventId)
            ],
            'entry_end_datetime' => 'required|date|after:entry_start_datetime',
            'start_datetime' => 'required|date|after:entry_end_datetime',
            'end_datetime' => [
                'required',
                'date',
            ],
        ];
    }

    public function attributes()
    {
        return [
            'name' => '予選ブロック名',
            'entry_fee' => 'エントリー料',
            'fixed_num' => '定員数',
            'entry_start_datetime' => 'エントリー開始日時',
            'entry_end_datetime' => 'エントリー終了日時',
            'start_datetime' => '対戦開始日時',
            'end_datetime' => '対戦終了日時',
        ];
    }

    public function messages()
    {
        return [
            'entry_start_datetime.validate_time' => ':attributeには、現時点より後の日付を指定してください。',
            'entry_fee.digits_between' => 'エントリー料には、15以下の数字を指定してください。',
        ];
    }
}

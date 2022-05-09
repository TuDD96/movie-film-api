<?php

namespace App\Http\Requests\App\Evaluation;

use Illuminate\Foundation\Http\FormRequest;

class CreateEvaluationRequest extends FormRequest
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
            'score' => 'required',
            'league_id' => 'nullable'
        ];
    }
}

<?php

namespace App\Http\Requests\Portal\Book;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\FilterSearchTableHandle;

class IndexRequest extends FormRequest
{
    use FilterSearchTableHandle;

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
            'user_id' => 'nullable', 
            'title' => 'nullable', 
            'league_id' => 'nullable',
            'sort' => 'nullable',
            'page' => 'nullable',
            'limit' => 'nullable',
        ];
    }

    public function validated()
    {
        $dataValidated = $this->validator->validated();

        if (isset($dataValidated['sort'])) {
            $dataValidated['sort'] = $this->extractFilter($dataValidated['sort']);
        }

        return $dataValidated;
    }
}

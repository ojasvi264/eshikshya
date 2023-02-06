<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'session_id' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
            'result_date' => 'required',
            'eclasses_id' => 'required',
            'section_id' => 'required',
            'exam_type_id' => 'required',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OnlineExamRequest extends FormRequest
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
            'title' => 'required',
            'exam_from_date' => 'required',
            'exam_from_time' => 'required',
            'exam_to_date' => 'required',
            'exam_to_time' => 'required',
            'auto_publis_result_date' => 'required',
            'auto_publis_result_time' => 'required',
            'time_duration' => 'required',
            'number_of_attempt' => 'required',
            'passing_percentage' => 'required',
            'description' => 'required',
        ];
    }
}

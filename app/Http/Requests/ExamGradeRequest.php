<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamGradeRequest extends FormRequest
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
            'per_from' => 'required|numeric',
            'per_to' => 'required|numeric',
            'grade_point' => 'required|numeric',
        ];
    }
}

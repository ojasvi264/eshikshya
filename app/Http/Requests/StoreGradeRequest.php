<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGradeRequest extends FormRequest
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
            'examType_id'=>'required',
            'grade_name'=>'required',
            'percent_upto'=>'required',
            'percent_from'=>'required',
            'grade_point'=>'required',
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'examType_id'=>'Please select exam type.',
            'grade_name'=>'Grade name is required.',
            'percent_upto'=>'Highest percentage limit is required.',
            'percent_from'=>'Lowest percentage limit is required.',
            'grade_point'=>'Grade point is required.',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHomeworkRequest extends FormRequest
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
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_id' => 'required',
            'assign' => 'required|date',
            'submission' => 'required|date',
            'submission_time' => 'required',
            'teacher_id' => 'required',
            //'image' => 'mimes:png,jpg,jpeg,pdf|max:2048',
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
            'class_id.required' => 'Please select the class.',
            'section_id.required' => 'Please select the section.',
            'subject_id.required' => 'Please select the subject.',
            'assign.required' => 'Assign date is required.',
            'submission.required' => 'Submission date is required.',
            'submission_time.required' => 'Submission time is required.',
            'description.required' => 'Description is required.',
            'teacher_id.required' => 'Please select the teacher.',
            //'image.mimes' => 'Please upload jpeg,jpg,png or pdf only.',
            'teacher_id' => 'Please select the teacher.',
        ];
    }
}

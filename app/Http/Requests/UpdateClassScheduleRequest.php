<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClassScheduleRequest extends FormRequest
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
            'title' => 'required|string',
            'schedule' => 'required|date',
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
            'title.required' => 'Title is required.',
            'title.string' => 'Title must be string.',
            'schedule.required' => 'Class schedule date is required.',
        ];
    }
}

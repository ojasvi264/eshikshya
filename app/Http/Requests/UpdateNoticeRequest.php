<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNoticeRequest extends FormRequest
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
            'notice' => 'required|date',
            'description' => 'required',
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
            'title.required' => 'Notice title is required.',
            'title.string' => 'Notice title must be string.',
            'notice.required' => 'Notice date is required.',
            'description.required' => 'Description is required.',
        ];
    }
}

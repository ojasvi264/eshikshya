<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdmissionInquiryRequest extends FormRequest
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
            'full_name' => 'required',
            'phone' => 'required',
            'email'=> 'email',
            'source_id' => 'required',
            'class_id' => 'nullable|integer',
            'teacher_id'=>'nullable|integer',
            'reference_id'=>'nullable|integer',
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
            'full_name.required' => 'Name is required.',
            'phone.required' => 'Phone number is required.',
            'source_id.required' => 'Please select the source.',
        ];
    }
}

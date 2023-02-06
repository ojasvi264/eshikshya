<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubjectRequest extends FormRequest
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
            'code' => 'required',
            'name' => 'required',
            'eclasses_ids' => 'required',
            'type' => 'required',
            'credit_hour' => 'required',
            'description' => 'nullable',
        ];
    }
    public function messages(){
        return [
            'code.required' => 'Subject code is required.',
            'name.required' => 'Subject name is required.',
            'eclasses_ids.required' => 'Please select class.',
            'type.required' => 'Please select type.',
            'credit_hour.required' => 'Credit Hour is required.',
        ];
    }
}

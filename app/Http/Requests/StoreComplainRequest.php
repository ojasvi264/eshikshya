<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreComplainRequest extends FormRequest
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
            'complainType_id' => 'required',
            'source_id' => 'required',
            'complain_by' => 'required',
            'phone' => 'required',
            'complain_date' => 'required',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function messages(){
        return [
            'complainType_id.required' => 'Please select complain type.',
            'source_id.required' => 'Please select source.',
            'complain_by.required' => 'Name is required.',
            'phone.required' => 'Phone number is required.',
            'complain_date.required' => 'Complain date is required.',
        ];
    }
}

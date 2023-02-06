<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePhoneCallLogRequest extends FormRequest
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
            'name'=>'required',
            'phone'=>'required',
            'date'=>'required',
            'follow_up_date'=>'required',
            'call_duration'=>'required',
            'call_type'=>'required'
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function messages(){
        return [
            'name.required' => 'Caller name is required.',
            'phone.required' => 'Caller phone number is required.',
            'date.required' => 'Date is required.',
            'follow_up_date.required' => 'Next follow up date is required.',
            'call_duration.required' => 'Call duration is required.',
            'call_type.required' => 'Call type is required.',
        ];
    }
}

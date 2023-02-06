<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchoolSettingRequest extends FormRequest
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
            'slogan' => 'required',
            'established_year' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phone_number' => 'required',
            'email_address' => 'required|email',
            'take_late_fee'=> 'required|integer',
            'type_of_late_fee' => 'required',
            'late_fee_value' => 'required|integer',
            'late_fee_after'=> 'required',
            'session_id'=> 'required',
            'result_type' => 'required',
            'address' => 'required',
        ];
    }
}

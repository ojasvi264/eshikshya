<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
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
            'fname' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed',
            //  'image'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            /*  'admission' => 'required',
              'roll' => 'required',*/
            //'category_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            /*     'class_id' => 'in:$data->id',
                 'section_id' =>  'in:$row->id',*/
            /* 'bloodgroup' => 'required|in:A+,A-,B+,B-,O+,AB+',
             'gender' => 'required|in:Male,Female,Other',
             'dob' => 'required',
             'phone' => 'required',
             'caste' => 'required',
             'religion' => 'required',
             'caddress' => 'required',
             'paddress' => 'required',*/
            // 'category_id'=> 'required'
            'profile_image' => 'nullable|file|image:png,jpeg,jpg,gif',
        ];
    }

    public function messages(){
        return [
            'fname.required' => 'name is  required.',
            'email.required' => 'email is required.',
           // 'email.unique' => 'email should be unique.',
            'password.required' => 'password is required.',
            'password.confirmed' => 'password is required.',
            //'category_id.required' => 'Please select category.',
            'class_id.required' => 'Please select the class.',
            /*      'class_id.in' => 'class xaina hai',
                  'section_id.in' => 'section xaina hai',*/
            'section_id.required' => 'Please again select the section.',
            'gender.required' => 'gender is required.',
            'gender.in' => 'Please select gender.',
            'dob.required' => 'dob is required.',
            'caddress.required' => 'caddress is required.',
            'paddress.required' => 'paddress is required.',
            'bloodgroup.required' => 'Blood Group is required',
            'bloodgroup.in' => 'Please select blood-group',
            'phone.required' => 'Contact number is required.',
            'caste.required' => 'Caste is required.'
        ];
    }
}

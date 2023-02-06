<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostalDispatchRequest extends FormRequest
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
            'to_title' => 'required',
            //'file' => 'mimes:jpg,png,jpeg,pdf,xlx,csv|max:2048',
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function messages(){
        return [
            'from_title.required' => 'From title is required.',
            //'file.mimes'=>'Please upload jpg,png,jpeg,pdf,xlx and csv only.'
        ];
    }
}

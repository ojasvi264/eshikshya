<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentInvoiceRequest extends FormRequest
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
            'student_id' => 'required',
            'due_date' => 'required',
            'fee_type_ids' => 'required',
            'qtys' => 'required',
            'for_month' => 'required'
        ];
    }
}

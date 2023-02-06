<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApplyLeaveRequest extends FormRequest
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
        $rules = [
            'apply_date' => 'required',
            'leave_type_id' => 'required',
            'leave_from' => 'required',
            'leave_to' => 'required',
            'reason' => 'required',
            'document' => 'required|file|mimes:docx,doc,pdf,xls,xlsx',
        ];
        if($this->method() == 'PATCH' || $this->method() == 'PUT'){
            $rules['document'] = 'nullable|file|mimes:docx,doc,pdf,xls,xlsx';
        }
        return $rules;
    }
}

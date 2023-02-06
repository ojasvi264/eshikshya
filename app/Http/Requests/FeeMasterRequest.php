<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeeMasterRequest extends FormRequest
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
            'fee_group_id' => 'required',
            'fees_type_id' => 'required',
            'due_date' => 'required',
            'amount' => 'required',
            'fine_type' => 'required',
            'percentage' => 'nullable|numeric',
            'fine_amount' => 'nullable|numeric',
        ];
    }
}

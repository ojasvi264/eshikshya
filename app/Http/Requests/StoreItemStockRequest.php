<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemStockRequest extends FormRequest
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
        $rules =  [
            'item_category_id' => 'required',
            'item_id' => 'required',
            'item_supplier_id' => 'required',
            'item_store_id' => 'required',
            'quantity' => 'required|integer|min:0',
            'purchase_price' => 'required|integer|min:0',
            'date' => 'required',
            'description' => 'nullable',
            'document' => 'required|mimes:docx,doc,pdf,xls,xlsx',
        ];
        if($this->method() == 'PATCH' || $this->method() == 'PUT'){
            $rules['document'] = 'nullable|mimes:docx,doc,pdf,xls,xlsx';
        }
        return $rules;
    }
}

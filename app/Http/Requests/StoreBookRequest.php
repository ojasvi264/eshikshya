<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
            'title' => 'required',
            'book_number' => 'required|integer',
            'isbn_number' => 'required|integer',
            'publisher' => 'required',
            'author' => 'required',
            'subject' => 'required',
            'rack_number' => 'required|integer',
            'quantity' => 'required|integer',
            'book_price' => 'required|integer',
            'post_date' => 'required',
            'description' => 'nullable',
        ];
    }
}

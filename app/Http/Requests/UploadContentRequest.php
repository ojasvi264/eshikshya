<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadContentRequest extends FormRequest
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
            'title',
            'content_type',
            'available_for',
            'upload_date|mimes:pdf,docx,doc',
            'description',
            'content_file'
        ];
    }
}

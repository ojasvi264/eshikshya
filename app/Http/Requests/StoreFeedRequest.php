<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFeedRequest extends FormRequest
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
    /*        'feed' => 'required|string',
            'feed_date' => 'required',
            'feed_content' => 'required',*/
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
/*            'feed.required' => 'Feed is required.',
            'feed.string' => 'Feed must be string.',
            'feed_date.required' => 'Feed date is required.',
            'feed_content.required' => 'The feed content is required.',*/
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleRequest extends FormRequest
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
            'vehicle_number' => 'required',
            'vehicle_model' => 'required',
            'year' => 'required',
            'driver_name' => 'required',
            'driver_license' => 'required',
            'driver_contact' => 'required',
            'note' => 'required'
        ];
    }
}

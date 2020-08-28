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
     * @return array
     */
    public function rules()
    {
        return [
            'capacity' => 'required',
            'trailer_type' => 'required',
            'route' => 'sometimes',
            'available_date' => 'required|date|after_or_equal:today',
            'city_from' => 'required',
            'city_to' => 'required',
            'country_from' => 'required',
            'country_to' => 'required',
            'load_type' =>'required',
            'more_details' =>'sometimes',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BidRequest extends FormRequest
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
            'price' => 'required',
            'available_capacity' => 'required',
            'trailer_type' => 'required',
            'country_location' => 'required',
            'city_location' => 'required',
            'date_available' => 'required|date|after_or_equal:today',
        ];
    }
}

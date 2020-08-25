<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoadRequest extends FormRequest
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
            'name'=>'required|min:2',
            'description'=>'sometimes',
            'requirements' =>'sometimes', 
            'transport_mode' => 'required',
            'size'=>'required|',
            'category_type'=>'required',
            'pickup_city'=>'required|min:2',
            'destination_city'=>'required|min:2',
            'pickup_country'=>'required|min:2',
            'destination_country'=>'required|min:2',
            'pickup_date'=>'required|date|after_or_equal:today',
            'destination_date'=>'required|date|after_or_equal:pickup_date',
            'pickup_street' =>'required|min:6',
            'destination_street' =>'required|min:6',
            'carriage_rate' =>'sometimes',
            'preferred_route' =>'sometimes',
            'quantity' =>'numeric',
            'payment_option' => 'required',
            'containers' =>'numeric|sometimes',
            'distance' => 'sometimes|numeric|gt:0',
            'trailer_type' => 'sometimes',
        ];
    }
}
          



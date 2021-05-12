<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
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
    public function rules(Request $request)
    {
        if ($request->image) {
            return [
                'service_id' =>  'required',  
                'from_city_id'=>  'required',
                'to_city_id'=> 'required',
                'date' => 'required',
                'address' => 'required',
                'flight_id' => 'required',
                'parking_id' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg',
            ];
        } else {
            return [
                'service_id' =>  'required',  
                'from_city_id'=>  'required',
                'to_city_id'=> 'required',
                'date' => 'required',
                'address' => 'required',
                'flight_id' => 'required',
                'parking_id' => 'required',
            ];
        }
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'service_id.required' => 'Service must be selected',
            'from_city_id.required' => 'Select From City',
            'to_city_id.required' => 'Select To City',
            'date.required' => 'Desired Date must be selected',
            'address.required' => 'Enter Complete Address',
            'flight_id.required' => 'Select Flight',
            'parking_id.required' => 'Select parking',
            'image.image' => 'Image must be in jpeg, png or jpg format',
        ];
    }    
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
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
            'name' =>  'required',  
            'first_trait'=>  'required',
            'second_trait'=> 'required',
            'third_trait' => 'required',
            'charges' => 'required|numeric',
            'status' => 'required',
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
            'name.required' => 'Enter Name for service',
            'first_trait.required' => 'first trait is required',
            'second_trait.required' => 'Second trait is required',
            'third_trait.required' => 'Third trait is required',
            'charges.required' => 'Enter charges for service',
            'charges.numeric' => 'Charges must be in number',
            'status.required' => 'Select status',
        ];
    }    
}

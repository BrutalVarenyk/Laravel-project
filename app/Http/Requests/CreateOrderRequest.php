<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    public function messages()
    {
        // Error's messages
        return [
            'name.required' => 'Name should be filled',
            'name.min' => 'Name should be more than 2 symbols',
            'name.max' => 'Name should be less than 35 symbols',

            'surname.required' => 'Surname should be filled',
            'surname.min' => 'Surname should be more than 2 symbols',
            'surname.max' => 'Surname should be less than 50 symbols',

            'phone.required' => 'Phone should be filled',

            'email.required' => 'Email should be filled',

            'country.required' => 'Country should be filled',
            'country.min' => 'Country should be more than 2 symbols',

            'city.required' => 'City should be filled',
            'city.min' => 'City should be more than 2 symbols',

            'address.required' => 'Address should be filled',
            'address.min' => 'Address should be more than 2 symbols',

        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:2|max:35',
            'surname' => 'required|min:2|max:50',
            'phone' => 'required',
            'email' => 'required',
            'country' => 'required|min:2',
            'city' => 'required|min:2',
            'address' => 'required|min:2'
        ];
    }
}

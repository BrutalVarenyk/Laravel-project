<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() && is_admin(auth()->user());
    }

    public function messages()
    {
        // Error's messages
        return [
            'title.required' => 'The product should contain a title',
            'title.min' => 'Title should be more than 5 symbols',
            'title.unique' => 'Title should be unique',

            'description.required' => 'The product should contain a description',
            'description.string' => 'The product description should contain words',
            'description.min' => 'Description should be more than 20 symbols ',

            'short_description.required' => 'The product should contain a short description',
            'short_description.string' => 'The product short description should contain words',
            'short_description.min' => 'Short description should be more than 20 symbols ',

            'SKU.required' => 'The product should contain a SKU',
            'SKU.min' => 'SKU should be more than 2 symbols',
            'SKU.unique' => 'SKU should be unique',

            'price.required' => 'The product should contain a price',
            'price.min' => 'Price should be more than 1$',
            'price.numeric' => 'Price should be more numeric',

            'discount.numeric' => 'Price should be more numeric',
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
            'category' => ['required', 'numeric'],
            'title' => ['required', 'min:5', 'unique:products'],
            'description' => ['required', 'string', 'min:20'],
            'short_description' => ['required', 'string', 'min:20', 'max:150'],
            'SKU'  => ['required', 'min:2', 'unique:products'],
            'price'  => ['required', 'numeric', 'min:1'],
            'discount' => ['required', 'numeric', 'max:90'],
            'in_stock' => ['required', 'numeric'],
            'thumbnail' => ['required', 'mimes:jpeg,jpg,png'],
            'images.*' => ['mimes:jpeg,jpg,png']
        ];
    }
}

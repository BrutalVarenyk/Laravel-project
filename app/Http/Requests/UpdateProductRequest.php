<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
        $productId = $this->route('product')->id;

        return [
            'category_id' => ['required', 'numeric'],
            'title' => ['required', 'min:5', Rule::unique('products', 'title')->ignore($productId)],
            'description' => ['required', 'string', 'min:20'],
            'short_description' => ['required', 'string', 'min:20', 'max:150'],
            'SKU'  => ['required', 'min:2', Rule::unique('products', 'SKU')->ignore($productId)],
            'price'  => ['required', 'numeric', 'min:1'],
            'discount' => ['required', 'numeric'],
            'in_stock' => ['required', 'numeric'],
            'thumbnail' => ['mimes:jpeg,jpg,png'],
            'images.*' => ['mimes:jpeg,jpg,png']
        ];
    }
}

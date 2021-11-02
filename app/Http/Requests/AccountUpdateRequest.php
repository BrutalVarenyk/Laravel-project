<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AccountUpdateRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $userId = auth()->user()->id;
        return [
            'name' => 'required|min:2|max:35',
            'surname' => 'required|min:2|max:50',
            'phone' => ['required', Rule::unique('users', 'phone')->ignore($userId)],
            'email' => ['required', Rule::unique('users', 'email')->ignore($userId)],
            'birthdate' => ['required', 'date']
        ];
    }
}

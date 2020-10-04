<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required',
            'phone'       => 'required|unique:users,phone',
            'email'       => 'required|unique:users,email',
            'password'              => 'required|string|between:5,15',
            'password' => 'required',
            'password_confirmation' => 'required_with:password|same:password|min:5',

        ];
    }
}

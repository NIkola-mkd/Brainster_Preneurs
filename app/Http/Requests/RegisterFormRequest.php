<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => [
                'required', 'min:6',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[-+_!@#$%^&*., ?]).+$/'
            ],
            'biography' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'surname.required' => 'Surname is required',
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
            'biography.required' => 'Biography is required',
            'email.email' => 'Please enter valid email address',
            'email.unique' => 'The user with this email address already exist',
            'password.regex' => 'Password must contain at least one capital letter, one lower letter and one special character',
            'password.min' => 'Password should be at least 6 characters long'

        ];
    }
}

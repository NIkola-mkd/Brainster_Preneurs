<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileRequest extends FormRequest
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
        if (Auth::user()->image == null) {
            return [
                'image' => ['required', 'mimes:jpeg,png,jpg', 'max:2048'],
                'name' => ['required', 'string', 'max:255'],
                'surname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email'],
                'biography' => ['required'],
                'skills' => ['required', 'min:5', 'max:10'],
                'academy' => ['required']

            ];
        } else {

            return [
                'name' => ['required', 'string', 'max:255'],
                'surname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email'],
                'image' => ['mimes:jpeg,png,jpg', 'max:2048'],
                'biography' => ['required'],
                'skills' => ['required', 'min:5', 'max:10'],
                'academy' => ['required']
            ];
        }
    }
    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'surname.required' => 'Surname is required',
            'email.required' => 'Email is required',
            'biography.required' => 'Biography is required',
            'email.email' => 'Please enter valid email address',
            'image.required' => 'The image is required',
            'image.mimes' => 'Invalid image format. Please insert .jpeg, .png, or .jpg',
            'image.max' => 'Image is too large. Allowed size is 2MB',
            'skills.required' => 'Please select skills',
            'skills.min' => 'Please select at least 5 skills',
            'skills.max' => 'You can not choose more than 10 skills',
            'academy.required' => "You must select your academy"

        ];
    }
}

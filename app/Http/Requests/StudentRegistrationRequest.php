<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use illuminate\Validation\Rules\Password;

class StudentRegistrationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'student_id' => [
                'required',
                'string',
                'max: 20',
                'unique: students, student_id',
                'regex: /^[0-9]{4}-[0-9]{5}$/',
            ],
            'first_name' => 'required|string|max:100|regex:^[a-zA-Z\s]+$/',
            'middle_name' => 'nullable|string|max:100|regex:^[a-zA-Z\s]+$/',
            'last_name' => 'required|string|max:100|regex:^[a-zA-Z\s]+$/',
            'email' => 'required|email|max:255|unique:students, email',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
            'course' => 'required|string|max:255',
            'year_level' => 'required|integer|min:1|max:5',
            'contact_number' => 'nullable|string|regex:/^(09|\+639)\d{9}$/',
        ];
    }

    public function messages()
    {
        return[
            'student_id.required' => 'Student ID is required.',
            'student_id.unique' => 'This Student ID is already registered.',
            'student_id.regex' => 'Student ID must be in format(YYYYNNNNN).',
            'first_name.required' => 'First name is required.',
            'first_name.regex' => 'First name should contain only letters and spaces',
            'middle_name.regex' => 'Middle name should contain only letters and spaces',
            'last_name.required' => 'Last name is required.',
            'last_name.regex' => 'Last name should contain only letters and spaces',
            'email.unique' => 'This email is already registered.',
            'password.confirmed' => 'Password confirmation does not match',
            'year_level.min' => 'Year level must be between 1 and 5',
            'year_level.max' => 'Year level must be between 1 and 5',
            'contact_number.regex' => 'Please enter a valid contact number.',
        ];
    }

    public function attributes()
    {
        return [
            'student_id' => 'student ID',
            'first_name' => 'first name',
            'middle_name' => 'middle name',
            'last_name' => 'last name',
            'year_level' => 'year level',
            'contact_number' => 'contact number',
        ];
    }
}

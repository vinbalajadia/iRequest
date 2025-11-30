<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('student')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $studentId = auth('student')->id();

        return [
            'first_name' => [
                'sometimes',
                'required',
                'string',
                'max:100',
                'regex:/^[a-zA-Z\s]+$/'
            ],
            'middle_name' => [
                'nullable',
                'string',
                'max:100',
                'regex:/^[a-zA-Z\s]+$/'
            ],
            'last_name' => [
                'sometimes',
                'required',
                'string',
                'max:100',
                'regex:/^[a-zA-Z\s]+$/'
            ],
            'email' => [
                'sometimes',
                'required',
                'email',
                'max:255',
                Rule::unique('students')->ignore($studentId)
            ],
            'contact_number' => [
                'nullable',
                'string',
                'regex:/^(09|\+639)\d{9}$/'
            ],
            'course' => [
                'sometimes',
                'required',
                'string',
                'max:255'
            ],
            'year_level' => [
                'sometimes',
                'required',
                'integer',
                'min:1',
                'max:5'
            ],
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'This email already exists. Please use a different email address.',
            'contact_number.regex' => 'The phone number format is invalid. It should start with 09 followed by 9 digits.',
        ];
    }
}

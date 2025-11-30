<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentLoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
            'remember' => ['nullable', 'boolean'],
        ];
    }

    public function messages()
    {
        return [
            'login.required' => 'Please enter your email or Student ID.',
            'password.required' => 'Password is required.',
        ];
    }

    public function isEmail()
    {
        return filter_var($this->login, FILTER_VALIDATE_EMAIL);
    }

    public function getCredentials()
    {
        return [
            $this->isEmail() ? 'email' : 'student_id' => $this->login,
            'password' => $this->password,
        ];
    }
}

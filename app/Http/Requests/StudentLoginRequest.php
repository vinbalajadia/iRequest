<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'login' => 'required|string',
            'password' => 'required|string',
            'remember' => 'nullable|boolean',
        ];
    }

    public function messages()
    {
        return[
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
        $login = $this->input('login');

        return[
            $this->isEmail() ? 'email' : 'student_id' => $login,
            'password' => $this->input('password'),
        ];
    }
}

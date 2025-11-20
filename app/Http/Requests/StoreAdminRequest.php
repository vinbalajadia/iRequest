<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use App\Models\Admin;

class StoreAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('admin')->check() && auth('admin')->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            $adminId = $this->route('admin') ?? null,

            'employee_id' => [
                'required',
                'string',
                'max:50',
                Rule::unique('admins', 'employee_id')->ignore($adminId),
            ],
            'first_name' => 'required|string|max:100|regex:/^[a-zA-Z\s]+$/',
            'middle_name' => 'nullable|string|max:100|regex:/^[a-zA-Z\s]+$/',
            'last_name' => 'required|string|max:100|regex:/^[a-zA-Z\s]+$/',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('admins', 'email')->ignore($adminId),
            ],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
            ],
            'department' => [
                'required',
                'string',
                'in:' . implode(',', array_keys(Admin::DEPARTMENTS)),
            ],
            'role' => [
                'required',
                'string',
                'in:' . implode(',', array_keys(Admin::ROLES)),
            ],
            'is_active' => 'nullable|boolean',
        ];
    }

    public function messages()
    {
        return [
            'employee_id.unique' => 'This employee ID already exists. Please use a different employee ID.',
            'email.unique' => 'This email already exists. Please use a different email address.',
            'passsword.confirmed' => 'Password confirmation does not match.',
        ];
    }
}

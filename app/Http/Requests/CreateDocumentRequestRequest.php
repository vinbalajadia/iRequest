<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDocumentRequestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('web')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'document_type' => 'required|string|max:255',
            'purpose' => 'required|string|max:500',
        ];
    }

    public function messages(): array
    {
        return[
            'document_type.required' => 'The document type field is required.',
            'document_type.in' => 'Invalid document type selected.',
            'purpose.required' => 'Please specify the purpose for this request',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\DocumentRequest;

class CreateDocumentRequestRequest extends FormRequest
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
        return [
            'document_type' => [
                'required',
                'string',
                'in:' . implode(',', array_keys(DocumentRequest::DOCUMENT_TYPES))
            ],
            'purpose' => [
                'required',
                'string',
                'min:10',
                'max:500'
            ],
            'copies' => [
                'nullable',
                'integer',
                'min:1',
                'max:10'
            ],
        ];
    }
    public function messages(): array
    {
        return [
            'document_type.required' => 'Please select a document type.',
            'document_type.in' => 'Invalid document type selected.',
            'purpose.required' => 'Please specify the purpose for this request.',
            'purpose.min' => 'Purpose must be at least 10 characters.',
            'purpose.max' => 'Purpose must not exceed 500 characters.',
            'copies.min' => 'You must request at least 1 copy.',
            'copies.max' => 'You can request maximum of 10 copies.',
        ];
    }

public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Change from 'web' to 'student'
            $student = auth('student')->user(); // ← Changed this line
            
            if (!$student) {
                return;
            }
            
            $existingRequest = $student->documentRequest() // Note: should be documentRequest not documentRequests
                ->where('document_type', $this->document_type)
                ->whereIn('status', ['pending', 'processing'])
                ->exists();

            if ($existingRequest) {
                $validator->errors()->add(
                    'document_type',
                    'You already have a pending request for this document type.'
                );
            }
        });
    }
}

<?php

namespace App\Http\Requests;

use App\Models\DocumentRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequestStatusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => [
                'required',
                'string',
                'in:'.implode(',', array_keys(DocumentRequest::STATUSES)),
            ],
            'admin_remarks' => 'nullable|string|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'status.required' => 'Status is required.',
            'status.in' => 'Invalid status selected.',
            'admin_remarks.max' => 'Admin remarks must not exceed 1000 characters.',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $request = DocumentRequest::find($this->route('document_request'));

            if (! $request) {
                $validator->errors()->add('document_request', 'Document does not exist.');

                return;
            }

            $newStatus = $this->status;

            $validTransitions = [
                DocumentRequest::STATUS_PENDING => [
                    DocumentRequest::STATUS_PROCESSING,
                    DocumentRequest::STATUS_REJECTED,
                ],
                DocumentRequest::STATUS_PROCESSING => [
                    DocumentRequest::STATUS_APPROVED,
                    DocumentRequest::STATUS_REJECTED,
                ],
                DocumentRequest::STATUS_APPROVED => [
                    DocumentRequest::STATUS_READY_FOR_PICKUP,
                    DocumentRequest::STATUS_REJECTED,
                ],
                DocumentRequest::STATUS_READY_FOR_PICKUP => [
                    DocumentRequest::STATUS_COMPLETED,
                ],
            ];

            $currentStatus = $request->status;

            if (isset($validTransitions[$currentStatus])) {
                if (! in_array($newStatus, $validTransitions[$currentStatus])) {
                    $validator->errors()->add(
                        'status',
                        "Cannot change status from {$currentStatus} to {$newStatus}."
                    );
                }
            } elseif ($currentStatus === DocumentRequest::STATUS_COMPLETED || $currentStatus === DocumentRequest::STATUS_REJECTED) {
                $validator->errors()->add()(
                    'status',
                    'Cannot modify a completed or rejected request.'
                );
            }
        });
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateRequestStatusRequest;
use App\Services\DocumentRequestService;
use App\Models\DocumentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RequestManagementController extends Controller
{
    protected $requestService;

    public function __construct(DocumentRequestService $requestService)
    {
        $this->requestService = $requestService;
    }

    public function index(Request $request)
    {
        $query = DocumentRequest::with('student')->orderBy('created_at', 'desc');

        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->has('document_type') && $request->document_type !== 'all') {
            $query->where('document_type', $request->document_type);
        }

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('request_number', 'LIKE', "%{$search}%")
                    ->orWhereHas('student', function ($q) use ($search) {
                        $q->where('first_name', 'LIKE', "%{$search}%")
                            ->orWhere('last_name', 'LIKE', "%{$search}%")
                            ->orWhere('student_id', 'LIKE', "%{$search}%");
                    });
            });
        }

        $requests = $query->paginate(15);
        $statuses = DocumentRequest::STATUSES;
        $documentTypes = DocumentRequest::DOCUMENT_TYPES;

        return view('admin.requests.index', compact('requests', 'statuses', 'documentTypes'));
    }

    public function show($id)
    {
        $request = DocumentRequest::with(['student', 'processedBy'])->findOrFail($id);
        $statuses = DocumentRequest::STATUSES;

        return view('admin.requests.show', compact('request', 'statuses'));
    }

    public function updateStatus(Request $request, $id)
    {
        // Log everything
        \Log::info('=== UPDATE STATUS DEBUG ===');
        \Log::info('Request ID: ' . $id);
        \Log::info('Form Data: ' . json_encode($request->all()));
        \Log::info('Admin ID: ' . auth('admin')->id());
        \Log::info('Admin Name: ' . auth('admin')->user()->name);

        try {
            // Validate
            $validated = $request->validate([
                'status' => 'required|string',
                'admin_remarks' => 'nullable|string',
            ]);

            \Log::info('Validation passed');

            // Find request
            $documentRequest = DocumentRequest::findOrFail($id);
            \Log::info('Found request: ' . $documentRequest->request_number);

            // Update
            $documentRequest->status = $validated['status'];
            $documentRequest->processed_by = auth('admin')->id();

            if (!empty($validated['admin_remarks'])) {
                $documentRequest->admin_remarks = $validated['admin_remarks'];
            }

            // Set timestamp
            if ($validated['status'] === 'processing' && !$documentRequest->processed_at) {
                $documentRequest->processed_at = now();
            }

            \Log::info('About to save...');
            $saved = $documentRequest->save();
            \Log::info('Save result: ' . ($saved ? 'SUCCESS' : 'FAILED'));

            return redirect()->route('admin.requests.show', $id)
                ->with('success', 'Status updated! Check: ' . $documentRequest->status);

        } catch (\Exception $e) {
            \Log::error('ERROR: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());

            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}

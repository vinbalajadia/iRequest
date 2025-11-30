<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateDocumentRequestRequest;
use App\Services\DocumentRequestService;
use App\Models\DocumentRequest;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    protected $requestService;

    public function __construct(DocumentRequestService $requestService)
    {
        $this->requestService = $requestService;
    }

    public function index()
    {
        $student = auth('student')->user();
        $requests = $this->requestService->getStudentRequests($student->id);

        return view('student.requests.index', compact('requests'));
    }

    public function create()
    {
        $documentTypes = DocumentRequest::getDocumentTypes();

        return view('student.requests.create', compact('documentTypes'));
    }

    public function store(CreateDocumentRequestRequest $request)
    {
        $data = $request->validated();
        $data['student_id'] = auth('student')->id();

        $documentRequest = $this->requestService->createRequest($data);

        return redirect()->route('student.requests.show', $documentRequest->id)
            ->with('success', 'Document request submitted successfully! Request ID: ' . $documentRequest->id);
    }

    public function show($id)
    {
        $request = $this->requestService->getRequestById($id);

        if (!$request || $request->student_id !== auth('student')->id()) {
            abort(404);
        }

        return view('student.requests.show', compact('request'));
    }

    public function track(Request $request)
    {
        if ($request->has('request_number')) {
            $documentRequest = $this->requestService->trackRequest($request->input('request_number'));

            if ($documentRequest && $documentRequest->student_id === auth('student')->id()) {
                return redirect()->route('student.requests.show', $documentRequest->id);
            }

            return back()->with('error', 'Request not found');
        }

        return view('student.requests.track');
    }
}

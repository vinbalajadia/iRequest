<?php

namespace App\Http\Controllers\Student; 

use App\Http\Controllers\Controller;
use App\Services\DocumentRequestService;
use Illuminate\Http\Request;

class DashboardController extends Controller
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

        $stats = [
            'total' => $requests->count(),
            'pending' => $requests->where('status', 'pending')->count(),
            'processing' => $requests->where('status', 'processing')->count(),
            'completed' => $requests->where('status', 'completed')->count(),
        ];

        $recentRequests = $requests->take(5);

        return view('student.dashboard', compact('student', 'stats', 'recentRequests'));
    }
}

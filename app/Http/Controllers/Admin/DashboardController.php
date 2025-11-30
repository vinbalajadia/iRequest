<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DocumentRequestService;
use App\Models\DocumentRequest;
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
        $admin = auth('admin')->user();

        $stats = [
            'pending' => DocumentRequest::pending()->count(),
            'processing' => DocumentRequest::processing()->count(),
            'completed' => DocumentRequest::completed()->whereDate('completed_at', today())->count(),
            'total_today' => DocumentRequest::whereDate('created_at', today())->count(),
        ];

        $pendingRequests = DocumentRequest::with('student')
            ->pending()
            ->orderBy('created_at', 'asc')
            ->take(10)
            ->get();

        $recentRequests = DocumentRequest::with('student')
            ->orderBy('updated_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('admin', 'stats', 'pendingRequests', 'recentRequests'));
    }
}

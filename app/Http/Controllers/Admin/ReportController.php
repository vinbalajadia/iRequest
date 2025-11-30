<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DocumentRequestService;
use App\Models\DocumentRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    protected $requestService;

    public function __construct(DocumentRequestService $requestService)
    {
        $this->requestService = $requestService;
    }

    public function index()
    {
        return view('admin.reports.index');
    }

    public function daily(Request $request)
    {
        $date = $request->input('date', today()->format('Y-m-d'));
        $report = $this->requestService->generateReports($date);

        $startDate = Carbon::parse($date)->startOfDay();
        $endDate = Carbon::parse($date)->endOfDay();

        $requests = DocumentRequest::with('student')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.reports.daily', compact('report', 'requests', 'date'));
    }
}

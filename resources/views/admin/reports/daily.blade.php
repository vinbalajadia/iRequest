@extends('layouts.admin')

@section('title', 'Daily Report')

@section('content')
<div class="py-10">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <a href="{{ route('admin.reports.index') }}" class="text-sm text-gray-600 hover:text-black mb-4 inline-block">← Back to Reports</a>
            <h1 class="text-4xl font-black text-black">Daily Report</h1>
        </div>

        <!-- Date Selector -->
        <div class="mb-6 border-2 border-black p-6 bg-white">
            <form method="GET" action="{{ route('admin.reports.daily') }}" class="flex gap-4 items-end">
                <div class="flex-1">
                    <label for="date" class="block text-sm font-bold text-gray-900 mb-2">Select Date</label>
                    <input type="date" id="date" name="date" value="{{ $date }}" max="{{ today()->format('Y-m-d') }}" class="block w-full border-2 border-black px-3 py-2 text-gray-900 focus:border-black focus:outline-none">
                </div>
                <button type="submit" class="bg-black text-white px-6 py-3 font-semibold hover:bg-gray-800">
                    Generate Report
                </button>
            </form>
        </div>

        <!-- Report Summary -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="border-2 border-black p-6 bg-black text-white">
                <p class="text-sm font-medium text-gray-300">Total Requests</p>
                <p class="text-4xl font-black mt-2">{{ $report['total_requests'] }}</p>
            </div>
            <div class="border-2 border-black p-6">
                <p class="text-sm font-medium text-gray-600">Pending</p>
                <p class="text-4xl font-black mt-2">{{ $report['pending'] }}</p>
            </div>
            <div class="border-2 border-black p-6">
                <p class="text-sm font-medium text-gray-600">Processing</p>
                <p class="text-4xl font-black mt-2">{{ $report['processing'] }}</p>
            </div>
            <div class="border-2 border-black p-6">
                <p class="text-sm font-medium text-gray-600">Completed</p>
                <p class="text-4xl font-black mt-2">{{ $report['completed'] }}</p>
            </div>
        </div>

        <!-- Detailed Requests -->
        <div class="border-2 border-black">
            <div class="bg-black text-white px-6 py-4">
                <h2 class="text-xl font-bold">Requests on {{ \Carbon\Carbon::parse($date)->format('F d, Y') }}</h2>
            </div>
            
            @if($requests->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y-2 divide-black">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">Time</th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">Request #</th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">Student</th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">Document</th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-300">
                            @foreach($requests as $request)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $request->created_at->format('h:i A') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">{{ $request->request_number }}</td>
                                <td class="px-6 py-4 text-sm">{{ $request->student->full_name }}</td>
                                <td class="px-6 py-4 text-sm">{{ $request->document_type_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-semibold border border-black">{{ $request->status_name }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-12 text-center">
                    <p class="text-gray-600">No requests found for this date.</p>
                </div>
            @endif
        </div>

        <!-- Print Button -->
        <div class="mt-6 text-right">
            <button onclick="window.print()" class="bg-black text-white px-6 py-3 font-semibold hover:bg-gray-800">
                Print Report
            </button>
        </div>
    </div>
</div>
@endsection
@extends('layouts.admin')

@section('title', 'Reports')

@section('content')
<div class="py-10">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-4xl font-black text-black">Reports</h1>
            <p class="mt-2 text-gray-600">Generate and view system reports</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Daily Report -->
            <div class="border-2 border-black p-8 hover:bg-gray-50 transition-colors">
                <h2 class="text-2xl font-bold mb-4">Daily Report</h2>
                <p class="text-gray-700 mb-6">View all requests processed on a specific date, including statistics and detailed breakdowns.</p>
                <a href="{{ route('admin.reports.daily') }}" class="inline-block bg-black text-white px-6 py-3 font-semibold hover:bg-gray-800">
                    View Daily Report
                </a>
            </div>

            <!-- Coming Soon -->
            <div class="border-2 border-black p-8 bg-gray-100">
                <h2 class="text-2xl font-bold mb-4">Weekly Report</h2>
                <p class="text-gray-700 mb-6">Comprehensive weekly summary of all requests and processing statistics.</p>
                <span class="inline-block border-2 border-black px-6 py-3 font-semibold text-gray-500">
                    Coming Soon
                </span>
            </div>

            <div class="border-2 border-black p-8 bg-gray-100">
                <h2 class="text-2xl font-bold mb-4">Monthly Report</h2>
                <p class="text-gray-700 mb-6">Monthly overview with trends and analysis of document requests.</p>
                <span class="inline-block border-2 border-black px-6 py-3 font-semibold text-gray-500">
                    Coming Soon
                </span>
            </div>

            <div class="border-2 border-black p-8 bg-gray-100">
                <h2 class="text-2xl font-bold mb-4">Custom Report</h2>
                <p class="text-gray-700 mb-6">Generate custom reports based on date ranges and specific criteria.</p>
                <span class="inline-block border-2 border-black px-6 py-3 font-semibold text-gray-500">
                    Coming Soon
                </span>
            </div>
        </div>
    </div>
</div>
@endsection
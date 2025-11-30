@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="fixed inset-0 -z-10 h-full w-full bg-zinc-50/50 [background-image:radial-gradient(#e5e7eb_1px,transparent_1px)] [background-size:24px_24px]"></div>

<div class="py-10">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        
        <div class="mb-10">
            <div class="flex items-center gap-3 mb-2">
                <div class="h-2 w-2 rounded-full bg-zinc-900 animate-pulse"></div>
                <span class="text-xs font-bold uppercase tracking-widest text-zinc-500">Admin Portal</span>
            </div>
            <h1 class="text-4xl font-extrabold tracking-tight text-zinc-900">Dashboard Overview</h1>
            <p class="mt-2 text-zinc-500">Welcome back, {{ $admin->first_name }}. Review pending items below.</p>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 mb-10">
            <div class="relative overflow-hidden rounded-2xl bg-zinc-900 p-6 shadow-lg shadow-zinc-900/20">
                <dt class="text-sm font-medium text-zinc-400">Pending Approvals</dt>
                <dd class="mt-4 text-5xl font-black text-white">{{ $stats['pending'] }}</dd>
                <div class="absolute right-0 top-0 h-24 w-24 translate-x-8 translate-y--8 rounded-full bg-white/5 blur-2xl"></div>
            </div>

            <div class="rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm">
                <dt class="text-sm font-medium text-zinc-500">Processing</dt>
                <dd class="mt-4 text-5xl font-black text-zinc-900">{{ $stats['processing'] }}</dd>
            </div>

            <div class="rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm">
                <dt class="text-sm font-medium text-zinc-500">Completed Today</dt>
                <dd class="mt-4 text-5xl font-black text-zinc-900">{{ $stats['completed'] }}</dd>
            </div>

            <div class="rounded-2xl border border-zinc-200 bg-zinc-50 p-6 shadow-sm">
                <dt class="text-sm font-medium text-zinc-500">Total Volume</dt>
                <dd class="mt-4 text-5xl font-black text-zinc-900">{{ $stats['total_today'] }}</dd>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-zinc-900">Pending Requests</h2>
                    <a href="{{ route('admin.requests.index') }}?status=pending" class="text-sm font-semibold text-zinc-900 hover:text-zinc-600">See all</a>
                </div>

                <div class="rounded-2xl border border-zinc-200 bg-white shadow-sm overflow-hidden">
                    @if($pendingRequests->count() > 0)
                        <div class="divide-y divide-zinc-100">
                            @foreach($pendingRequests as $request)
                            <div class="group flex items-center justify-between p-6 transition-all hover:bg-zinc-50">
                                <div class="flex gap-4">
                                    <div class="flex h-12 w-12 flex-none items-center justify-center rounded-xl bg-zinc-100 text-zinc-500 group-hover:bg-zinc-900 group-hover:text-white transition-colors">
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <p class="text-sm font-bold text-zinc-900">{{ $request->request_number }}</p>
                                            <span class="inline-flex items-center rounded-md bg-zinc-100 px-2 py-0.5 text-xs font-medium text-zinc-600">
                                                {{ $request->document_type_name }}
                                            </span>
                                        </div>
                                        <p class="mt-1 text-sm text-zinc-500">Requested by <span class="font-medium text-zinc-900">{{ $request->student->full_name }}</span></p>
                                        <p class="mt-1 text-xs text-zinc-400">{{ $request->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                
                                <a href="{{ route('admin.requests.show', $request->id) }}" class="rounded-lg bg-white px-3.5 py-2 text-sm font-semibold text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 hover:bg-zinc-50 hover:ring-zinc-400">
                                    Process
                                </a>
                            </div>
                            @endforeach
                        </div>
                        <div class="bg-zinc-50 px-6 py-4 text-center border-t border-zinc-100">
                            <a href="{{ route('admin.requests.index') }}?status=pending" class="text-xs font-semibold uppercase tracking-wider text-zinc-500 hover:text-zinc-900">View All Pending</a>
                        </div>
                    @else
                        <div class="p-12 text-center">
                            <p class="text-zinc-500">No pending requests at the moment.</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="space-y-6">
                
                <div class="rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm">
                    <h3 class="font-bold text-zinc-900 mb-4">Control Panel</h3>
                    <div class="space-y-3">
                        <a href="{{ route('admin.requests.index') }}" class="group flex items-center justify-between rounded-lg bg-zinc-50 p-3 text-sm font-medium text-zinc-900 hover:bg-zinc-100 hover:text-zinc-900">
                            <span>Manage All Requests</span>
                            <span class="text-zinc-400 group-hover:translate-x-1 transition-transform">&rarr;</span>
                        </a>
                        <a href="{{ route('admin.reports.daily') }}" class="group flex items-center justify-between rounded-lg bg-zinc-50 p-3 text-sm font-medium text-zinc-900 hover:bg-zinc-100 hover:text-zinc-900">
                            <span>Generate Reports</span>
                            <span class="text-zinc-400 group-hover:translate-x-1 transition-transform">&rarr;</span>
                        </a>
                        </div>
                </div>

                <div class="rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm">
                    <h3 class="font-bold text-zinc-900 mb-4">Recent Activity</h3>
                    <div class="relative pl-4 border-l border-zinc-200 space-y-6">
                        @foreach($recentRequests->take(5) as $request)
                        <div class="relative">
                            <div class="absolute -left-[21px] top-1 h-2.5 w-2.5 rounded-full border-2 border-white bg-zinc-300"></div>
                            <p class="text-sm font-medium text-zinc-900">{{ $request->request_number }}</p>
                            <p class="text-xs text-zinc-500">
                                Status updated to <span class="font-medium text-zinc-700">{{ $request->status_name }}</span>
                            </p>
                            <p class="mt-0.5 text-[10px] text-zinc-400 uppercase tracking-wide">{{ $request->updated_at->diffForHumans() }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
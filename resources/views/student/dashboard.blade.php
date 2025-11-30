@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="fixed inset-0 -z-10 h-full w-full bg-white [background-image:radial-gradient(#e5e7eb_1px,transparent_1px)] [background-size:24px_24px] [mask-image:radial-gradient(ellipse_at_center,white,transparent)]"></div>

<div class="py-10">
    <header class="mb-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-extrabold tracking-tight text-zinc-900">Dashboard</h1>
                    <p class="mt-2 text-zinc-500">Welcome back, {{ $student->first_name }}. Here is your overview.</p>
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 mb-10">
                <div class="group relative overflow-hidden rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm transition-all hover:shadow-md">
                    <dt class="truncate text-sm font-medium text-zinc-500">Total Requests</dt>
                    <dd class="mt-2 flex items-baseline gap-2">
                        <span class="text-3xl font-bold tracking-tight text-zinc-900">{{ $stats['total'] }}</span>
                    </dd>
                </div>

                <div class="group relative overflow-hidden rounded-2xl border border-zinc-200 bg-zinc-900 p-6 shadow-sm transition-all hover:shadow-md">
                    <dt class="truncate text-sm font-medium text-zinc-400">Pending Actions</dt>
                    <dd class="mt-2 flex items-baseline gap-2">
                        <span class="text-3xl font-bold tracking-tight text-white">{{ $stats['pending'] }}</span>
                    </dd>
                    <div class="absolute right-4 top-4 text-zinc-700 group-hover:text-zinc-600">
                        <svg class="h-6 w-6 text-white/20" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                </div>

                <div class="group relative overflow-hidden rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm transition-all hover:shadow-md">
                    <dt class="truncate text-sm font-medium text-zinc-500">Processing</dt>
                    <dd class="mt-2 flex items-baseline gap-2">
                        <span class="text-3xl font-bold tracking-tight text-zinc-900">{{ $stats['processing'] }}</span>
                    </dd>
                </div>

                <div class="group relative overflow-hidden rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm transition-all hover:shadow-md">
                    <dt class="truncate text-sm font-medium text-zinc-500">Completed</dt>
                    <dd class="mt-2 flex items-baseline gap-2">
                        <span class="text-3xl font-bold tracking-tight text-zinc-900">{{ $stats['completed'] }}</span>
                    </dd>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-zinc-900">Recent Requests</h2>
                        <a href="{{ route('student.requests.index') }}" class="text-sm font-semibold text-zinc-900 hover:text-zinc-600 transition-colors">View all &rarr;</a>
                    </div>

                    @if($recentRequests->count() > 0)
                        <div class="overflow-hidden rounded-2xl border border-zinc-200 bg-white shadow-sm">
                            <table class="min-w-full divide-y divide-zinc-100">
                                <thead class="bg-zinc-50/50">
                                    <tr>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-500">Request #</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-500">Document</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-500">Status</th>
                                        <th scope="col" class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-zinc-500">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-zinc-100 bg-white">
                                    @foreach($recentRequests as $request)
                                    <tr class="group transition-colors hover:bg-zinc-50/50">
                                        <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-zinc-900">{{ $request->request_number }}</td>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm text-zinc-600">{{ $request->document_type_name }}</td>
                                        <td class="whitespace-nowrap px-6 py-4">
                                            <span class="inline-flex items-center rounded-md bg-zinc-100 px-2 py-1 text-xs font-medium text-zinc-700 ring-1 ring-inset ring-zinc-600/10 group-hover:bg-zinc-200">
                                                {{ $request->status_name }}
                                            </span>
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4 text-right text-sm">
                                            <a href="{{ route('student.requests.show', $request->id) }}" class="font-medium text-zinc-900 hover:text-zinc-600">Details</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center rounded-2xl border-2 border-dashed border-zinc-200 bg-zinc-50 py-12 text-center">
                            <svg class="mx-auto h-12 w-12 text-zinc-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-semibold text-zinc-900">No requests yet</h3>
                            <p class="mt-1 text-sm text-zinc-500">Get started by creating a new document request.</p>
                            <div class="mt-6">
                                <a href="{{ route('student.requests.create') }}" class="inline-flex items-center rounded-lg bg-zinc-900 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-zinc-800">
                                    Create Request
                                </a>
                            </div>
                        </div>
                    @endif
                </div>

                <div>
                    <h2 class="text-xl font-bold text-zinc-900 mb-6">Quick Actions</h2>
                    <div class="flex flex-col gap-3">
                        <a href="{{ route('student.requests.create') }}" class="flex w-full items-center justify-between rounded-xl bg-zinc-900 p-4 text-white shadow-sm transition-all hover:bg-zinc-800 hover:shadow-md">
                            <span class="font-semibold">New Request</span>
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" /></svg>
                        </a>
                        
                        <a href="{{ route('student.requests.track') }}" class="flex w-full items-center justify-between rounded-xl border border-zinc-200 bg-white p-4 text-zinc-900 shadow-sm transition-all hover:border-zinc-300 hover:shadow-md">
                            <span class="font-semibold">Track Request</span>
                            <svg class="h-5 w-5 text-zinc-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" /></svg>
                        </a>

                        <div class="mt-6 rounded-2xl bg-zinc-50 p-6 border border-zinc-100">
                            <h3 class="font-semibold text-zinc-900">Need Help?</h3>
                            <p class="mt-2 text-sm text-zinc-500">If you have issues with your request, contact the registrar.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
</div>
@endsection
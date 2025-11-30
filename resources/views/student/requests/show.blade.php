@extends('layouts.app')

@section('title', 'Request Details')

@section('content')
<div class="py-12">
    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
        
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                <li><a href="{{ route('student.requests.index') }}" class="text-sm font-medium text-zinc-500 hover:text-zinc-900">Requests</a></li>
                <li><span class="text-zinc-300">/</span></li>
                <li><span class="text-sm font-medium text-zinc-900" aria-current="page">{{ $request->request_number }}</span></li>
            </ol>
        </nav>

        <div class="md:flex md:items-center md:justify-between mb-8">
            <div class="min-w-0 flex-1">
                <h2 class="text-2xl font-bold leading-7 text-zinc-900 sm:truncate sm:text-3xl sm:tracking-tight">Request Details</h2>
                <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6">
                    <div class="mt-2 flex items-center text-sm text-zinc-500">
                        <svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-zinc-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" /></svg>
                        Requested on {{ $request->created_at->format('F d, Y') }}
                    </div>
                </div>
            </div>
            <div class="mt-4 flex md:ml-4 md:mt-0">
                <span class="inline-flex items-center rounded-lg bg-zinc-900 px-3 py-1.5 text-sm font-semibold text-white shadow-sm">
                    {{ $request->status_name }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                <div class="overflow-hidden rounded-2xl border border-zinc-200 bg-white shadow-sm">
                    <div class="px-6 py-5 border-b border-zinc-100 bg-zinc-50/50">
                        <h3 class="text-base font-semibold leading-6 text-zinc-900">Information</h3>
                    </div>
                    <div class="px-6 py-6">
                        <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-zinc-500">Document Type</dt>
                                <dd class="mt-1 text-sm font-semibold text-zinc-900">{{ $request->document_type_name }}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-zinc-500">Estimated Completion</dt>
                                <dd class="mt-1 text-sm font-semibold text-zinc-900">
                                    {{ $request->estimated_completion ? $request->estimated_completion->format('M d, Y') : 'Pending Schedule' }}
                                </dd>
                            </div>
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-zinc-500">Purpose</dt>
                                <dd class="mt-1 text-sm text-zinc-900 leading-relaxed max-w-prose">{{ $request->purpose }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                @if($request->admin_remarks)
                <div class="rounded-2xl border border-blue-100 bg-blue-50 p-6">
                    <h3 class="text-sm font-bold text-blue-900 mb-2">Note from Registrar</h3>
                    <p class="text-sm text-blue-700">{{ $request->admin_remarks }}</p>
                </div>
                @endif
            </div>

            <div class="space-y-6">
                <div class="rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm">
                    <h3 class="text-base font-semibold leading-6 text-zinc-900 mb-6">Status History</h3>
                    <div class="flow-root">
                        <ul role="list" class="-mb-8">
                            
                            <li>
                                <div class="relative pb-8">
                                    <span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-zinc-200" aria-hidden="true"></span>
                                    <div class="relative flex space-x-3">
                                        <div>
                                            <span class="h-8 w-8 rounded-full bg-zinc-900 flex items-center justify-center ring-4 ring-white">
                                                <svg class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                            </span>
                                        </div>
                                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                            <div>
                                                <p class="text-sm font-medium text-zinc-900">Request Submitted</p>
                                            </div>
                                            <div class="whitespace-nowrap text-right text-xs text-zinc-500">
                                                {{ $request->created_at->format('M d') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            @if($request->processed_at)
                            <li>
                                <div class="relative pb-8">
                                    <span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-zinc-200" aria-hidden="true"></span>
                                    <div class="relative flex space-x-3">
                                        <div>
                                            <span class="h-8 w-8 rounded-full bg-blue-600 flex items-center justify-center ring-4 ring-white">
                                                <svg class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                                            </span>
                                        </div>
                                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                            <div>
                                                <p class="text-sm font-medium text-zinc-900">Processing</p>
                                            </div>
                                            <div class="whitespace-nowrap text-right text-xs text-zinc-500">
                                                {{ $request->processed_at->format('M d') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endif

                            @if($request->ready_at)
                            <li>
                                <div class="relative pb-8">
                                    <div class="relative flex space-x-3">
                                        <div>
                                            <span class="h-8 w-8 rounded-full bg-emerald-500 flex items-center justify-center ring-4 ring-white">
                                                <svg class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                            </span>
                                        </div>
                                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                            <div>
                                                <p class="text-sm font-medium text-zinc-900">Ready for Pickup</p>
                                            </div>
                                            <div class="whitespace-nowrap text-right text-xs text-zinc-500">
                                                {{ $request->ready_at->format('M d') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endif

                        </ul>
                    </div>
                </div>

                <div class="rounded-2xl border border-zinc-200 bg-zinc-50 p-6">
                    <h3 class="text-sm font-bold text-zinc-900 mb-2">Need Assistance?</h3>
                    <p class="text-sm text-zinc-600 mb-4">Contact the Registrar's Office for urgent concerns regarding this request.</p>
                    <div class="space-y-2 text-sm">
                        <p class="font-medium text-zinc-900">vebalajadia@fit.edu.ph</p>
                        <p class="text-zinc-500">09773566183</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
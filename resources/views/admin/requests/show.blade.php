@extends('layouts.admin')

@section('title', 'Request Details')

@section('content')
<div class="py-12">
    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8 flex items-center justify-between">
            <div>
                <a href="{{ route('admin.requests.index') }}" class="text-sm font-medium text-zinc-500 hover:text-zinc-900 mb-2 inline-flex items-center transition-colors">
                    <svg class="mr-1 h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" /></svg>
                    Back to Requests
                </a>
                <div class="flex items-baseline gap-4 mt-1">
                    <h1 class="text-3xl font-extrabold tracking-tight text-zinc-900">{{ $request->request_number }}</h1>
                    <span class="inline-flex items-center rounded-md bg-zinc-100 px-2 py-1 text-sm font-medium text-zinc-700">
                        {{ $request->status_name }}
                    </span>
                </div>
            </div>
            
            <button type="button" onclick="window.print()" class="hidden sm:inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 hover:bg-zinc-50">
                <svg class="-ml-0.5 mr-1.5 h-5 w-5 text-zinc-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5 2a1 1 0 011-1h8a1 1 0 011 1v2h2a1 1 0 011 1v9a1 1 0 01-1 1h-2v2a1 1 0 01-1 1H6a1 1 0 01-1-1v-2H3a1 1 0 01-1-1V5a1 1 0 011-1h2V2zm2 14h6v-3H7v3zm8-12H5v2h10V4zM4 6v9h12V6H4zm1 1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd" /></svg>
                Print Details
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-6">
                
                <div class="overflow-hidden rounded-2xl border border-zinc-200 bg-white shadow-sm">
                    <div class="px-6 py-5 border-b border-zinc-100 bg-zinc-50/50">
                        <h3 class="text-sm font-semibold leading-6 text-zinc-900">Student Information</h3>
                    </div>
                    <div class="px-6 py-6">
                        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-6">
                            <div>
                                <dt class="text-xs font-medium text-zinc-500 uppercase tracking-wide">Full Name</dt>
                                <dd class="mt-1 text-sm font-bold text-zinc-900">{{ $request->student->full_name }}</dd>
                            </div>
                            <div>
                                <dt class="text-xs font-medium text-zinc-500 uppercase tracking-wide">Student ID</dt>
                                <dd class="mt-1 text-sm font-medium text-zinc-900">{{ $request->student->student_id }}</dd>
                            </div>
                            <div>
                                <dt class="text-xs font-medium text-zinc-500 uppercase tracking-wide">Email</dt>
                                <dd class="mt-1 text-sm text-zinc-900">{{ $request->student->email }}</dd>
                            </div>
                            <div>
                                <dt class="text-xs font-medium text-zinc-500 uppercase tracking-wide">Course</dt>
                                <dd class="mt-1 text-sm text-zinc-900">{{ $request->student->course }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <div class="overflow-hidden rounded-2xl border border-zinc-200 bg-white shadow-sm">
                    <div class="px-6 py-5 border-b border-zinc-100 bg-zinc-50/50">
                        <h3 class="text-sm font-semibold leading-6 text-zinc-900">Request Information</h3>
                    </div>
                    <div class="px-6 py-6">
                        <dl class="grid grid-cols-1 gap-y-6">
                            <div class="flex justify-between border-b border-zinc-50 pb-4">
                                <div>
                                    <dt class="text-xs font-medium text-zinc-500 uppercase tracking-wide">Document Type</dt>
                                    <dd class="mt-1 text-lg font-bold text-zinc-900">{{ $request->document_type_name }}</dd>
                                </div>
                                <div class="text-right">
                                    <dt class="text-xs font-medium text-zinc-500 uppercase tracking-wide">Copies</dt>
                                    <dd class="mt-1 text-lg font-bold text-zinc-900">{{ $request->copies ?? 1 }}</dd>
                                </div>
                            </div>
                            
                            <div>
                                <dt class="text-xs font-medium text-zinc-500 uppercase tracking-wide">Purpose</dt>
                                <dd class="mt-2 text-sm text-zinc-700 bg-zinc-50 p-4 rounded-lg border border-zinc-100 leading-relaxed">
                                    {{ $request->purpose }}
                                </dd>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4 pt-2">
                                <div>
                                    <dt class="text-xs font-medium text-zinc-500 uppercase tracking-wide">Date Requested</dt>
                                    <dd class="mt-1 text-sm text-zinc-900">{{ $request->created_at->format('F d, Y h:i A') }}</dd>
                                </div>
                                <div>
                                    <dt class="text-xs font-medium text-zinc-500 uppercase tracking-wide">Last Updated</dt>
                                    <dd class="mt-1 text-sm text-zinc-900">{{ $request->updated_at->diffForHumans() }}</dd>
                                </div>
                            </div>
                        </dl>
                    </div>
                </div>

            </div>

            <div class="space-y-6">
                
                <div class="rounded-2xl border border-zinc-200 bg-white shadow-lg shadow-zinc-200/50">
                    <div class="p-6">
                        <h3 class="font-bold text-zinc-900 mb-4">Update Status</h3>
                        
                        @if ($request->status !== 'completed' && $request->status !== 'rejected')
                        <form action="{{ route('admin.requests.update-status', $request->id) }}" method="POST" class="space-y-5">
                            @csrf
                            @method('PUT')

                            <div>
                                <label for="status" class="block text-xs font-medium uppercase tracking-wide text-zinc-500 mb-1.5">New Status</label>
                                <select id="status" name="status" required class="block w-full rounded-lg border-0 py-2.5 text-zinc-900 ring-1 ring-inset ring-zinc-300 focus:ring-2 focus:ring-inset focus:ring-zinc-900 sm:text-sm sm:leading-6">
                                    @foreach ($statuses as $key => $name)
                                        <option value="{{ $key }}" {{ $request->status == $key ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="admin_remarks" class="block text-xs font-medium uppercase tracking-wide text-zinc-500 mb-1.5">Remarks / Notes</label>
                                <textarea id="admin_remarks" name="admin_remarks" rows="3" class="block w-full rounded-lg border-0 py-2 text-zinc-900 ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-zinc-900 sm:text-sm sm:leading-6" placeholder="Notify student...">{{ $request->admin_remarks }}</textarea>
                            </div>

                            <button type="submit" class="w-full rounded-lg bg-zinc-900 px-3 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-zinc-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-zinc-900 transition-all">
                                Update Request
                            </button>
                        </form>
                        @else
                            <div class="rounded-lg bg-zinc-50 p-4 text-center border border-zinc-100">
                                <p class="text-sm text-zinc-500">This request is <strong>{{ $request->status }}</strong> and can no longer be updated.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="rounded-2xl border border-zinc-200 bg-zinc-50 p-6">
                    <h3 class="text-xs font-bold text-zinc-900 uppercase tracking-wide mb-4">Internal Info</h3>
                    <dl class="space-y-4 text-sm">
                        <div class="flex justify-between">
                            <dt class="text-zinc-500">Processed By</dt>
                            <dd class="font-medium text-zinc-900">{{ $request->processedBy->name ?? '—' }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-zinc-500">Processing Time</dt>
                            <dd class="font-medium text-zinc-900">{{ $request->processing_time ?? '—' }}</dd>
                        </div>
                    </dl>
                </div>

                @if (session('success'))
                    <div class="rounded-lg bg-emerald-50 p-4 text-sm font-medium text-emerald-800 ring-1 ring-inset ring-emerald-600/20">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="rounded-lg bg-red-50 p-4 text-sm font-medium text-red-800 ring-1 ring-inset ring-red-600/20">
                        {{ session('error') }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
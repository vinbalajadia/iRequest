@extends('layouts.app')

@section('title', 'My Requests')

@section('content')
<div class="py-12">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-extrabold tracking-tight text-zinc-900">My Requests</h1>
                <p class="mt-1 text-zinc-500">Track and manage your document history.</p>
            </div>
            <a href="{{ route('student.requests.create') }}" class="inline-flex items-center justify-center rounded-lg bg-zinc-900 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-zinc-800 transition-all">
                <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" /></svg>
                New Request
            </a>
        </div>

        @if($requests->count() > 0)
            <div class="overflow-hidden rounded-xl border border-zinc-200 bg-white shadow-sm">
                <table class="min-w-full divide-y divide-zinc-200">
                    <thead class="bg-zinc-50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-500">Request #</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-500">Document</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-500">Status</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-500">Date</th>
                            <th scope="col" class="relative px-6 py-4"><span class="sr-only">Actions</span></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100 bg-white">
                        @foreach($requests as $request)
                        <tr class="group hover:bg-zinc-50/50 transition-colors">
                            <td class="whitespace-nowrap px-6 py-4 text-sm font-bold text-zinc-900">{{ $request->request_number }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-zinc-600">{{ $request->document_type_name }}</td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium 
                                    @if($request->status === 'completed') bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20
                                    @elseif($request->status === 'rejected') bg-red-50 text-red-700 ring-1 ring-inset ring-red-600/20
                                    @elseif($request->status === 'ready_for_pickup') bg-blue-50 text-blue-700 ring-1 ring-inset ring-blue-600/20
                                    @else bg-zinc-100 text-zinc-700 ring-1 ring-inset ring-zinc-600/10 @endif">
                                    {{ $request->status_name }}
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-zinc-500">{{ $request->created_at->format('M d, Y') }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                <a href="{{ route('student.requests.show', $request->id) }}" class="text-zinc-400 hover:text-zinc-900 transition-colors">View Details &rarr;</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="flex flex-col items-center justify-center rounded-2xl border-2 border-dashed border-zinc-200 bg-zinc-50/50 py-20 text-center">
                <div class="rounded-full bg-zinc-100 p-3 mb-4">
                    <svg class="h-8 w-8 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-sm font-semibold text-zinc-900">No requests found</h3>
                <p class="mt-1 text-sm text-zinc-500">Get started by creating your first document request.</p>
                <div class="mt-6">
                    <a href="{{ route('student.requests.create') }}" class="inline-flex items-center rounded-lg bg-zinc-900 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-zinc-800">
                        Create Request
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
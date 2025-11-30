@extends('layouts.admin')

@section('title', 'Manage Requests')

@section('content')
<div class="fixed inset-0 -z-10 h-full w-full bg-zinc-50/50 [background-image:radial-gradient(#e5e7eb_1px,transparent_1px)] [background-size:24px_24px]"></div>

<div class="py-12">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-extrabold tracking-tight text-zinc-900">Document Requests</h1>
                <p class="mt-1 text-sm text-zinc-500">View and manage all student submissions.</p>
            </div>
            </div>

        <div class="rounded-xl border border-zinc-200 bg-white p-5 shadow-sm mb-6">
            <form method="GET" action="{{ route('admin.requests.index') }}" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                
                <div class="md:col-span-5">
                    <label for="search" class="block text-xs font-semibold uppercase tracking-wide text-zinc-500 mb-1.5">Search</label>
                    <div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-4 w-4 text-zinc-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="text" id="search" name="search" value="{{ request('search') }}" 
                            placeholder="Request #, Name, or ID" 
                            class="block w-full rounded-lg border-0 py-2 pl-9 text-zinc-900 ring-1 ring-inset ring-zinc-200 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-zinc-900 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div class="md:col-span-3">
                    <label for="status" class="block text-xs font-semibold uppercase tracking-wide text-zinc-500 mb-1.5">Status</label>
                    <select id="status" name="status" 
                        class="block w-full rounded-lg border-0 py-2 pl-3 pr-10 text-zinc-900 ring-1 ring-inset ring-zinc-200 focus:ring-2 focus:ring-inset focus:ring-zinc-900 sm:text-sm sm:leading-6">
                        <option value="all">All Status</option>
                        @foreach($statuses as $key => $name)
                            <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="md:col-span-3">
                    <label for="document_type" class="block text-xs font-semibold uppercase tracking-wide text-zinc-500 mb-1.5">Type</label>
                    <select id="document_type" name="document_type" 
                        class="block w-full rounded-lg border-0 py-2 pl-3 pr-10 text-zinc-900 ring-1 ring-inset ring-zinc-200 focus:ring-2 focus:ring-inset focus:ring-zinc-900 sm:text-sm sm:leading-6">
                        <option value="all">All Documents</option>
                        @foreach($documentTypes as $key => $name)
                            <option value="{{ $key }}" {{ request('document_type') == $key ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="md:col-span-1 flex justify-end">
                    <button type="submit" class="inline-flex items-center justify-center rounded-lg bg-zinc-900 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-zinc-800 transition-colors w-full">
                        Filter
                    </button>
                </div>
            </form>
            @if(request()->hasAny(['search', 'status', 'document_type']))
            <div class="mt-3 border-t border-zinc-100 pt-3 flex justify-end">
                 <a href="{{ route('admin.requests.index') }}" class="text-xs font-medium text-zinc-500 hover:text-zinc-900 hover:underline">
                    Clear active filters
                </a>
            </div>
            @endif
        </div>

        <div class="overflow-hidden rounded-xl border border-zinc-200 bg-white shadow-sm">
            @if($requests->count() > 0)
                <table class="min-w-full divide-y divide-zinc-100">
                    <thead class="bg-zinc-50/50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-500">Request Details</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-500">Student</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-500">Status</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-500">Date</th>
                            <th scope="col" class="relative px-6 py-4"><span class="sr-only">Actions</span></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100 bg-white">
                        @foreach($requests as $request)
                        <tr class="group hover:bg-zinc-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="text-sm font-bold text-zinc-900">{{ $request->request_number }}</span>
                                    <span class="text-xs text-zinc-500 mt-0.5">{{ $request->document_type_name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="h-8 w-8 flex-shrink-0 rounded-full bg-zinc-100 text-zinc-500 flex items-center justify-center text-xs font-bold">
                                        {{ substr($request->student->first_name, 0, 1) }}{{ substr($request->student->last_name, 0, 1) }}
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-zinc-900">{{ $request->student->full_name }}</div>
                                        <div class="text-xs text-zinc-500">{{ $request->student->student_id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset
                                    {{ $request->status === 'pending' ? 'bg-yellow-50 text-yellow-800 ring-yellow-600/20' : '' }}
                                    {{ $request->status === 'processing' ? 'bg-blue-50 text-blue-700 ring-blue-700/10' : '' }}
                                    {{ $request->status === 'ready_for_pickup' ? 'bg-purple-50 text-purple-700 ring-purple-700/10' : '' }}
                                    {{ $request->status === 'completed' ? 'bg-emerald-50 text-emerald-700 ring-emerald-600/20' : '' }}
                                    {{ $request->status === 'rejected' ? 'bg-red-50 text-red-700 ring-red-600/10' : '' }}
                                ">
                                    {{ $request->status_name }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500">
                                {{ $request->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.requests.show', $request->id) }}" class="text-zinc-400 hover:text-zinc-900 font-semibold transition-colors">
                                    Process &rarr;
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="flex flex-col items-center justify-center py-16 text-center">
                    <div class="rounded-full bg-zinc-50 p-3 mb-3">
                        <svg class="h-6 w-6 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-zinc-900">No requests found</h3>
                    <p class="mt-1 text-sm text-zinc-500">Try adjusting your search or filters.</p>
                </div>
            @endif
        </div>

        <div class="mt-6">
            {{ $requests->links() }}
        </div>
    </div>
</div>
@endsection
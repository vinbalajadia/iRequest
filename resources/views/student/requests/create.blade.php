@extends('layouts.app')

@section('title', 'Create New Request')

@section('content')
<div class="fixed inset-0 -z-10 h-full w-full bg-white [background-image:radial-gradient(#e5e7eb_1px,transparent_1px)] [background-size:24px_24px]"></div>

<div class="py-12">
    <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
        <div class="mb-10 text-center">
            <h1 class="text-3xl font-extrabold tracking-tight text-zinc-900">New Document Request</h1>
            <p class="mt-2 text-zinc-500">Submit a request for official academic records.</p>
        </div>

        <div class="rounded-2xl border border-zinc-200 bg-white p-8 shadow-sm">
            <form action="{{ route('student.requests.store') }}" method="POST" class="space-y-8">
                @csrf

                <div>
                    <label for="document_type" class="block text-sm font-semibold text-zinc-900">Document Type <span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <select id="document_type" name="document_type" required 
                            class="block w-full rounded-lg border-0 py-3 pl-3 pr-10 text-zinc-900 ring-1 ring-inset ring-zinc-200 focus:ring-2 focus:ring-zinc-900 sm:text-sm sm:leading-6">
                            <option value="">Select a document type</option>
                            @foreach($documentTypes as $key => $name)
                                <option value="{{ $key }}" {{ old('document_type') == $key ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('document_type')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <div class="flex justify-between">
                        <label for="copies" class="block text-sm font-semibold text-zinc-900">Number of Copies</label>
                        <span class="text-xs text-zinc-500">Max: 10</span>
                    </div>
                    <div class="mt-2">
                        <input type="number" id="copies" name="copies" value="{{ old('copies', 1) }}" min="1" max="10" 
                            class="block w-full rounded-lg border-0 py-3 text-zinc-900 ring-1 ring-inset ring-zinc-200 placeholder:text-zinc-400 focus:ring-2 focus:ring-zinc-900 sm:text-sm sm:leading-6">
                    </div>
                    @error('copies')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <div class="flex justify-between">
                        <label for="purpose" class="block text-sm font-semibold text-zinc-900">Purpose <span class="text-red-500">*</span></label>
                        <span class="text-xs text-zinc-500">10-500 chars</span>
                    </div>
                    <div class="mt-2">
                        <textarea id="purpose" name="purpose" rows="4" required 
                            placeholder="e.g., For employment application, scholarship requirements..." 
                            class="block w-full rounded-lg border-0 py-3 text-zinc-900 ring-1 ring-inset ring-zinc-200 placeholder:text-zinc-400 focus:ring-2 focus:ring-zinc-900 sm:text-sm sm:leading-6">{{ old('purpose') }}</textarea>
                    </div>
                    @error('purpose')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="rounded-xl bg-amber-50 p-4 ring-1 ring-inset ring-amber-600/10">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-amber-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-bold text-amber-800">Important Reminders</h3>
                            <div class="mt-2 text-sm text-amber-700">
                                <ul class="list-disc space-y-1 pl-5">
                                    <li>Processing time is 3-14 working days.</li>
                                    <li>Wait for the email notification before visiting.</li>
                                    <li>Valid ID is required for claiming.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-x-6 border-t border-zinc-100 pt-6">
                    <a href="{{ route('student.dashboard') }}" class="text-sm font-semibold leading-6 text-zinc-900 hover:text-zinc-600">Cancel</a>
                    <button type="submit" class="rounded-lg bg-zinc-900 px-8 py-3 text-sm font-semibold text-white shadow-sm hover:bg-zinc-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-zinc-900 transition-all">
                        Submit Request
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
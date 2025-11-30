@extends('layouts.app')

@section('title', 'Track Request')

@section('content')
<div class="min-h-[80vh] flex flex-col justify-center py-12">
    <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8 w-full">
        
        <div class="text-center mb-10">
            <h1 class="text-4xl font-extrabold tracking-tight text-zinc-900">Track Request</h1>
            <p class="mt-2 text-lg text-zinc-500">Check the real-time status of your document.</p>
        </div>

        <div class="rounded-2xl border border-zinc-200 bg-white p-2 shadow-lg shadow-zinc-200/50">
            <form action="{{ route('student.requests.track') }}" method="GET">
                <div class="relative flex items-center">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                        <svg class="h-6 w-6 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" name="request_number" required 
                        placeholder="REQ-2024-11-XXXX" 
                        class="block w-full border-0 py-5 pl-12 pr-32 text-lg text-zinc-900 placeholder:text-zinc-300 focus:ring-0 rounded-xl"
                    >
                    <div class="absolute inset-y-2 right-2">
                        <button type="submit" class="h-full rounded-lg bg-zinc-900 px-6 text-sm font-semibold text-white hover:bg-zinc-800 transition-colors">
                            Track
                        </button>
                    </div>
                </div>
            </form>
        </div>

        @if(session('error'))
            <div class="mt-6 rounded-xl bg-red-50 p-4 text-sm font-medium text-red-800 ring-1 ring-inset ring-red-600/20 text-center animate-pulse">
                {{ session('error') }}
            </div>
        @endif

        <div class="mt-12 grid grid-cols-1 sm:grid-cols-3 gap-6 text-center">
            <div class="p-4 rounded-xl bg-zinc-50 border border-zinc-100">
                <div class="text-2xl mb-2">📧</div>
                <p class="text-xs font-medium text-zinc-900">Check Email</p>
                <p class="text-[10px] text-zinc-500">Look for confirmation email</p>
            </div>
            <div class="p-4 rounded-xl bg-zinc-50 border border-zinc-100">
                <div class="text-2xl mb-2">🔢</div>
                <p class="text-xs font-medium text-zinc-900">Format</p>
                <p class="text-[10px] text-zinc-500">REQ-YYYY-MM-XXXX</p>
            </div>
            <div class="p-4 rounded-xl bg-zinc-50 border border-zinc-100">
                <div class="text-2xl mb-2">📋</div>
                <p class="text-xs font-medium text-zinc-900">Dashboard</p>
                <p class="text-[10px] text-zinc-500">View "My Requests" page</p>
            </div>
        </div>
    </div>
</div>
@endsection
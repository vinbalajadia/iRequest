@extends('layouts.app')

    @section('content')
    <div class="max-w-4xl mx-auto mt-10">
        <h2 class="text-2xl font-bold mb-4">My Requests</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 text-left">Document</th>
                    <th class="p-2 text-left">Status</th>
                    <th class="p-2 text-left">Remarks</th>
                    <th class="p-2 text-left">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requests as $request)
                    <tr class="border-t">
                        <td class="p-2">{{ $request->document_type }}</td>
                        <td class="p-2 capitalize">{{ $request->status }}</td>
                        <td class="p-2">{{ $request->remarks ?? 'N/A' }}</td>
                        <td class="p-2">{{ $request->created_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
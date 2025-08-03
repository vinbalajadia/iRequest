@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4">Request a Document</h2>

    <form action="/request" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block font-medium">Document Type</label>
            <select name="document_type" class="w-full border p-2 rounded" required>
                <option value="TOR">Transcript of Records</option>
                <option value="Good Moral">Good Moral Certificate</option>
                <option value="Certificate of Enrollment">Certificate of Enrollment</option>
            </select>
        </div>

        <div>
            <label class="block font-medium">Remarks (optional)</label>
            <textarea name="remarks" class="w-full border p-2 rounded"></textarea>
        </div>

        <button class="bg-green-600 text-white font-bold px-4 py-2 rounded hover:shadow-lg">Submit</button>
    </form>
</div>
@endsection


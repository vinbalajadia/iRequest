@extends('layouts.app')
@section('content')
    <div class="max-w-md mx-auto mt-10 bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Edit Profile</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('student.edit-profile') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block font-medium">Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border px-3 py-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block font-medium">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border px-3 py-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block font-medium">Profile Photo</label>
                <input type="file" name="profile_photo" class="w-full border px-3 py-2 rounded">
            </div>

            <button class="bg-green-600 text-white px-4 py-2 rounded hover:shadow-lg">Save Changes</button>
        </form>
    </div>
@endsection

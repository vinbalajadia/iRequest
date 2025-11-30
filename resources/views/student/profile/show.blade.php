@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="py-10">
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
        <div class="mb-8 flex justify-between items-center">
            <h1 class="text-4xl font-black text-black">My Profile</h1>
            <a href="{{ route('student.profile.edit') }}" class="bg-black text-white px-6 py-2 font-semibold hover:bg-gray-800">
                Edit Profile
            </a>
        </div>

        <div class="border-2 border-black p-8 bg-white">
            <!-- Profile Header -->
            <div class="flex items-center space-x-6 mb-8 pb-8 border-b-2 border-gray-200">
                <div class="h-24 w-24 rounded-full bg-black text-white flex items-center justify-center text-3xl font-bold">
                    {{ $student->initials }}
                </div>
                <div>
                    <h2 class="text-2xl font-bold">{{ $student->full_name }}</h2>
                    <p class="text-gray-600">{{ $student->student_id }}</p>
                </div>
            </div>

            <!-- Profile Details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-600 mb-1">First Name</label>
                    <p class="text-lg">{{ $student->first_name }}</p>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-600 mb-1">Middle Name</label>
                    <p class="text-lg">{{ $student->middle_name ?? 'N/A' }}</p>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-600 mb-1">Last Name</label>
                    <p class="text-lg">{{ $student->last_name }}</p>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-600 mb-1">Student ID</label>
                    <p class="text-lg">{{ $student->student_id }}</p>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-600 mb-1">Email Address</label>
                    <p class="text-lg">{{ $student->email }}</p>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-600 mb-1">Course</label>
                    <p class="text-lg">{{ $student->course }}</p>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-600 mb-1">Year Level</label>
                    <p class="text-lg">{{ $student->year_level }}{{ $student->year_level == 1 ? 'st' : ($student->year_level == 2 ? 'nd' : ($student->year_level == 3 ? 'rd' : 'th')) }} Year</p>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-600 mb-1">Phone Number</label>
                    <p class="text-lg">{{ $student->phone_number ?? 'Not provided' }}</p>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-gray-600 mb-1">Member Since</label>
                    <p class="text-lg">{{ $student->created_at->format('F d, Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Account Statistics -->
        <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="border-2 border-black p-4 text-center">
                <p class="text-3xl font-black">{{ $student->getTotalRequestsCount() }}</p>
                <p class="text-sm text-gray-600">Total Requests</p>
            </div>
            <div class="border-2 border-black p-4 text-center">
                <p class="text-3xl font-black">{{ $student->getPendingRequestsCount() }}</p>
                <p class="text-sm text-gray-600">Pending Requests</p>
            </div>
            <div class="border-2 border-black p-4 text-center">
                <p class="text-3xl font-black">{{ $student->getCompletedRequestsCount() }}</p>
                <p class="text-sm text-gray-600">Completed Requests</p>
            </div>
        </div>
    </div>
</div>
@endsection
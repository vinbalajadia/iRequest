@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="py-12">
    <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <a href="{{ route('student.profile.show') }}" class="text-sm font-medium text-zinc-500 hover:text-zinc-900 mb-4 inline-block">&larr; Back to Profile</a>
            <h1 class="text-3xl font-bold tracking-tight text-zinc-900">Edit Profile</h1>
            <p class="mt-2 text-zinc-500">Update your personal information.</p>
        </div>

        <div class="rounded-2xl border border-zinc-200 bg-white p-8 shadow-sm">
            <form action="{{ route('student.profile.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-2">
                    <div class="sm:col-span-1">
                        <label for="first_name" class="block text-sm font-medium leading-6 text-zinc-900">First Name</label>
                        <div class="mt-2">
                            <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $student->first_name) }}" required
                                class="block w-full rounded-md border-0 py-2 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-zinc-900 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-1">
                        <label for="last_name" class="block text-sm font-medium leading-6 text-zinc-900">Last Name</label>
                        <div class="mt-2">
                            <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $student->last_name) }}" required
                                class="block w-full rounded-md border-0 py-2 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-zinc-900 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="middle_name" class="block text-sm font-medium leading-6 text-zinc-900">Middle Name <span class="text-zinc-400 font-normal">(Optional)</span></label>
                        <div class="mt-2">
                            <input type="text" name="middle_name" id="middle_name" value="{{ old('middle_name', $student->middle_name) }}"
                                class="block w-full rounded-md border-0 py-2 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-zinc-900 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="email" class="block text-sm font-medium leading-6 text-zinc-900">Email Address</label>
                        <div class="mt-2">
                            <input type="email" name="email" id="email" value="{{ old('email', $student->email) }}" required
                                class="block w-full rounded-md border-0 py-2 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-zinc-900 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-1">
                        <label for="course" class="block text-sm font-medium leading-6 text-zinc-900">Course</label>
                        <div class="mt-2">
                            <input type="text" name="course" id="course" value="{{ old('course', $student->course) }}" required
                                class="block w-full rounded-md border-0 py-2 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-zinc-900 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-1">
                        <label for="year_level" class="block text-sm font-medium leading-6 text-zinc-900">Year Level</label>
                        <div class="mt-2">
                            <select id="year_level" name="year_level" required
                                class="block w-full rounded-md border-0 py-2 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 focus:ring-2 focus:ring-inset focus:ring-zinc-900 sm:text-sm sm:leading-6">
                                <option value="1" {{ old('year_level', $student->year_level) == 1 ? 'selected' : '' }}>1st Year</option>
                                <option value="2" {{ old('year_level', $student->year_level) == 2 ? 'selected' : '' }}>2nd Year</option>
                                <option value="3" {{ old('year_level', $student->year_level) == 3 ? 'selected' : '' }}>3rd Year</option>
                                <option value="4" {{ old('year_level', $student->year_level) == 4 ? 'selected' : '' }}>4th Year</option>
                                <option value="5" {{ old('year_level', $student->year_level) == 5 ? 'selected' : '' }}>5th Year</option>
                            </select>
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="phone_number" class="block text-sm font-medium leading-6 text-zinc-900">Phone Number</label>
                        <div class="mt-2">
                            <input type="text" name="phone_number" id="phone_number" value="{{ old('contact_number', $student->contact_number) }}" placeholder="09XXXXXXXXX"
                                class="block w-full rounded-md border-0 py-2 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-zinc-900 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-4 border-t border-zinc-100 pt-6">
                    <a href="{{ route('student.profile.show') }}" class="text-sm font-semibold leading-6 text-zinc-900 hover:text-zinc-600">Cancel</a>
                    <button type="submit" class="rounded-lg bg-zinc-900 px-6 py-2 text-sm font-semibold text-white shadow-sm hover:bg-zinc-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-zinc-900 transition-colors">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
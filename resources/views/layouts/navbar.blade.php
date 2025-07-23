@php
    $user = Auth::user();
    $initials = strtoupper(substr($user->name, 0, 1));
@endphp

<nav class="bg-white shadow mb-4">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
        <a href="{{ route('dashboard') }}" class="text-lg font-semibold text-gray-800">
            iRequest
        </a>

        <div class="flex items-center gap-4">
            <!-- Profile Display -->
            <a href="{{ route('student.edit-profile') }}" class="relative">
                @if ($user->profile_photo_path)
                    <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="Profile Photo"
                         class="w-10 h-10 rounded-full object-cover border border-gray-400">
                @else
                    <div class="w-10 h-10 rounded-full bg-gray-400 text-white flex items-center justify-center font-bold">
                        {{ $initials }}
                    </div>
                @endif
            </a>

            <!-- Logout Button -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-red-600 hover:underline">Logout</button>
            </form>
        </div>
    </div>
</nav>

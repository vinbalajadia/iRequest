<!DOCTYPE html>
<html lang="en" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'iRequest System')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .bg-dot-pattern {
            background-image: radial-gradient(#e5e7eb 1px, transparent 1px);
            background-size: 24px 24px;
        }
    </style>
</head>
<body class="h-full bg-white bg-dot-pattern text-zinc-900 antialiased">
    <div class="min-h-full flex flex-col">
        
        <nav class="sticky top-0 z-50 w-full border-b border-zinc-200 bg-white/80 backdrop-blur-xl">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    
                    <div class="flex items-center gap-8">
                        <div class="flex-shrink-0 flex items-center gap-2">
                             <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-zinc-900 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="h-5 w-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                </svg>
                            </div>
                            <h1 class="text-lg font-bold tracking-tight text-zinc-900">iRequest</h1>
                        </div>
                        
                        <div class="hidden md:block">
                            <div class="flex items-baseline space-x-1">
                                <a href="{{ route('student.dashboard') }}"
                                    class="px-3 py-2 rounded-md text-sm font-medium transition-colors {{ request()->routeIs('student.dashboard') ? 'bg-zinc-100 text-zinc-900' : 'text-zinc-500 hover:text-zinc-900 hover:bg-zinc-50' }}">
                                    Dashboard
                                </a>
                                <a href="{{ route('student.requests.index') }}"
                                    class="px-3 py-2 rounded-md text-sm font-medium transition-colors {{ request()->routeIs('student.requests.*') ? 'bg-zinc-100 text-zinc-900' : 'text-zinc-500 hover:text-zinc-900 hover:bg-zinc-50' }}">
                                    My Requests
                                </a>
                                <a href="{{ route('student.requests.track') }}"
                                    class="px-3 py-2 rounded-md text-sm font-medium transition-colors {{ request()->routeIs('student.requests.track') ? 'bg-zinc-100 text-zinc-900' : 'text-zinc-500 hover:text-zinc-900 hover:bg-zinc-50' }}">
                                    Track Request
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="hidden md:block">
                        <div class="ml-4 flex items-center md:ml-6">
                            <div class="relative">
                                <button type="button" id="user-menu-button" onclick="toggleDropdown(event)"
                                    class="flex items-center gap-3 rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-zinc-200 focus:ring-offset-2 p-1 pr-2 transition-all hover:bg-zinc-50">
                                    <span class="sr-only">Open user menu</span>
                                    <div class="h-8 w-8 rounded-full bg-zinc-900 text-white flex items-center justify-center font-bold text-xs ring-2 ring-white">
                                        {{ auth('student')->user()->initials }}
                                    </div>
                                    <span class="text-sm font-medium text-zinc-700">{{ auth('student')->user()->first_name }}</span>
                                    <svg class="h-4 w-4 text-zinc-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                </button>
                                
                                <div id="userDropdown"
                                    class="hidden absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-xl bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none transform transition-all">
                                    <div class="px-4 py-2 border-b border-zinc-100">
                                        <p class="text-xs text-zinc-500">Signed in as</p>
                                        <p class="text-sm font-bold text-zinc-900 truncate">{{ auth('student')->user()->email }}</p>
                                    </div>
                                    <a href="{{ route('student.profile.show') }}"
                                        class="block px-4 py-2 text-sm text-zinc-700 hover:bg-zinc-50 transition-colors">Your Profile</a>
                                    <form method="POST" action="{{ route('student.logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                            Sign out
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <main class="flex-grow">
            @if (session('success'))
                <div class="mx-auto max-w-7xl py-4 px-4 sm:px-6 lg:px-8">
                    <div class="rounded-xl bg-zinc-900 p-4 shadow-lg shadow-zinc-200/50 flex items-center gap-3">
                         <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-green-400">
                          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                        </svg>
                        <p class="text-sm font-medium text-white">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="mx-auto max-w-7xl py-4 px-4 sm:px-6 lg:px-8">
                    <div class="rounded-xl bg-red-50 border border-red-100 p-4 flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-red-500">
                          <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                        </svg>
                        <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            @yield('content')
        </main>
        
        <footer class="border-t border-zinc-200 bg-white py-8 mt-auto">
            <div class="mx-auto max-w-7xl px-6 text-center">
                <p class="text-xs text-zinc-500">&copy; {{ date('Y') }} iRequest System. All rights reserved.</p>
            </div>
        </footer>
    </div>

    <script>
        function toggleDropdown(event) {
            event.stopPropagation();
            const dropdown = document.getElementById('userDropdown');
            // Simple animation handling
            if (dropdown.classList.contains('hidden')) {
                dropdown.classList.remove('hidden');
                dropdown.classList.add('opacity-100', 'scale-100');
                dropdown.classList.remove('opacity-0', 'scale-95');
            } else {
                dropdown.classList.add('hidden');
            }
        }

        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('userDropdown');
            const button = document.getElementById('user-menu-button');
            if (dropdown && !dropdown.classList.contains('hidden')) {
                if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                    dropdown.classList.add('hidden');
                }
            }
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const dropdown = document.getElementById('userDropdown');
                if (dropdown) dropdown.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
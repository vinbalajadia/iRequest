<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Portal') - iRequest</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-zinc-50 font-sans antialiased text-zinc-900">
    
    <div class="min-h-screen flex flex-col">
        
        <nav class="sticky top-0 z-50 w-full border-b border-zinc-200 bg-white/80 backdrop-blur-xl">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 justify-between items-center">
                    
                    <div class="flex items-center gap-8">
                        <div class="flex items-center gap-2">
                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-zinc-900 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="h-5 w-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                </svg>
                            </div>
                            <span class="font-bold tracking-tight text-zinc-900">iRequest</span>
                            <span class="rounded-full bg-zinc-100 px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider text-zinc-500 border border-zinc-200">
                                Admin
                            </span>
                        </div>

                        <div class="hidden sm:flex sm:gap-6">
                            <a href="{{ route('admin.dashboard') }}" 
                               class="text-sm font-medium transition-colors {{ request()->routeIs('admin.dashboard') ? 'text-zinc-900' : 'text-zinc-500 hover:text-zinc-900' }}">
                                Dashboard
                            </a>
                            <a href="{{ route('admin.requests.index') }}" 
                               class="text-sm font-medium transition-colors {{ request()->routeIs('admin.requests*') ? 'text-zinc-900' : 'text-zinc-500 hover:text-zinc-900' }}">
                                Requests
                            </a>
                            <a href="{{ route('admin.reports.index') }}" 
                               class="text-sm font-medium transition-colors {{ request()->routeIs('admin.reports*') ? 'text-zinc-900' : 'text-zinc-500 hover:text-zinc-900' }}">
                                Reports
                            </a>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <span class="text-xs text-zinc-400 hidden sm:block">Signed in as Admin</span>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="rounded-lg bg-zinc-900 px-4 py-2 text-xs font-semibold text-white shadow-sm hover:bg-zinc-800 transition-colors">
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <main class="flex-grow">
            @yield('content')
        </main>

        <footer class="border-t border-zinc-200 bg-white py-6">
            <div class="mx-auto max-w-7xl px-6 text-center">
                <p class="text-xs text-zinc-400">&copy; {{ date('Y') }} iRequest System. Authorized Personnel Only.</p>
            </div>
        </footer>
    </div>
</body>
</html>
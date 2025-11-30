<!DOCTYPE html>
<html lang="en" class="h-full bg-zinc-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - iRequest System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="h-full flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8">
    
    <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
        <span class="inline-flex items-center rounded-full bg-zinc-100 px-3 py-1 text-xs font-medium text-zinc-800 ring-1 ring-inset ring-zinc-600/20 mb-4">
            Authorized Personnel Only
        </span>
        <h2 class="text-2xl font-bold leading-9 tracking-tight text-zinc-900">Admin Portal</h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-[400px]">
        <div class="bg-white px-6 py-10 shadow-sm ring-1 ring-zinc-900/5 sm:rounded-xl sm:px-10">
            
            @if(session('success'))
                <div class="mb-6 rounded-md bg-emerald-50 p-4 ring-1 ring-inset ring-emerald-600/20">
                    <div class="flex">
                        <div class="ml-3">
                            <p class="text-sm font-medium text-emerald-800">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 rounded-md bg-red-50 p-4 ring-1 ring-inset ring-red-600/10">
                    <div class="flex">
                        <div class="ml-3">
                            <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <form class="space-y-6" action="{{ route('admin.login') }}" method="POST">
                @csrf
                
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-zinc-900">Email Address</label>
                    <div class="mt-2">
                        <input id="email" name="email" type="email" required value="{{ old('email') }}" 
                        class="block w-full rounded-md border-0 py-2 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-zinc-900 sm:text-sm sm:leading-6 transition-shadow">
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium leading-6 text-zinc-900">Password</label>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" required 
                        class="block w-full rounded-md border-0 py-2 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-zinc-900 sm:text-sm sm:leading-6 transition-shadow">
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" class="h-4 w-4 rounded border-zinc-300 text-zinc-900 focus:ring-zinc-900">
                        <label for="remember" class="ml-3 block text-sm leading-6 text-zinc-900">Remember me</label>
                    </div>
                </div>

                <div>
                    <button type="submit" class="flex w-full justify-center rounded-md bg-zinc-900 px-3 py-2 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-zinc-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-zinc-900 transition-colors">
                        Sign in
                    </button>
                </div>
            </form>

            <div class="mt-8 border-t border-zinc-100 pt-6">
                 <p class="text-center text-xs text-zinc-400">
                    <a href="{{ route('welcome') }}" class="hover:text-zinc-600 transition-colors">&larr; Return to main site</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
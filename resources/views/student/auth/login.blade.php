<!DOCTYPE html>
<html lang="en" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login - iRequest</title>
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
<body class="h-full flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8 bg-dot-pattern">
    
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-zinc-900 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="h-7 w-7">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
            </svg>
        </div>
        <h2 class="mt-6 text-center text-2xl font-bold leading-9 tracking-tight text-zinc-900">Sign in to your account</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-[400px]">
        <div class="bg-white/80 backdrop-blur-xl px-6 py-10 shadow-xl shadow-zinc-200/50 sm:rounded-2xl sm:px-10 border border-zinc-200">
            <form class="space-y-6" action="{{ route('student.login.submit') }}" method="POST">
                @csrf

                <div>
                    <label for="login" class="block text-sm font-medium leading-6 text-zinc-900">Email or Student ID</label>
                    <div class="mt-2">
                        <input id="login" name="login" type="text" value="{{ old('login') }}" required 
                        class="block w-full rounded-md border-0 py-2 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-zinc-900 sm:text-sm sm:leading-6 transition-shadow">
                    </div>
                    @error('login')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium leading-6 text-zinc-900">Password</label>
                    </div>
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
                        <label for="remember" class="ml-3 block text-sm leading-6 text-zinc-600">Remember me</label>
                    </div>
                </div>

                <div>
                    <button type="submit" class="flex w-full justify-center rounded-md bg-zinc-900 px-3 py-2 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-zinc-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-zinc-900 transition-all">
                        Sign in
                    </button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm text-zinc-500">
                Not a member?
                <a href="{{ route('student.register') }}" class="font-semibold leading-6 text-zinc-900 hover:text-zinc-700 hover:underline">Create an account</a>
            </p>
            
            <p class="mt-4 text-center text-xs text-zinc-400">
                <a href="{{ route('welcome') }}" class="hover:text-zinc-600 transition-colors">&larr; Back to home</a>
            </p>
        </div>
    </div>
</body>
</html>
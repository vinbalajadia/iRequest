<!DOCTYPE html>
<html lang="en" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Register - iRequest</title>
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
<body class="h-full flex items-center justify-center bg-white bg-dot-pattern">
    
    <div class="w-full max-w-lg p-8 bg-white/80 backdrop-blur-xl border border-zinc-200 rounded-2xl shadow-xl shadow-zinc-200/50">
        
        <div class="mb-8 text-center">
             <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-lg bg-zinc-900 text-white mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold tracking-tight text-zinc-900">Create an account</h2>
            <p class="mt-2 text-sm text-zinc-600">Enter your details to access the portal.</p>
        </div>

        <form action="{{ route('student.register.submit') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="student_id" class="block text-sm font-medium leading-6 text-zinc-900">Student ID</label>
                <div class="mt-2">
                    <input type="text" name="student_id" id="student_id" required 
                    class="block w-full rounded-md border-0 py-2.5 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-zinc-900 sm:text-sm sm:leading-6 transition-shadow">
                </div>
            </div>

            <div class="grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-2">
                <div>
                    <label for="first_name" class="block text-sm font-medium leading-6 text-zinc-900">First Name</label>
                    <div class="mt-2">
                        <input type="text" name="first_name" id="first_name" required 
                        class="block w-full rounded-md border-0 py-2.5 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-zinc-900 sm:text-sm sm:leading-6 transition-shadow">
                    </div>
                </div>

                <div>
                    <label for="last_name" class="block text-sm font-medium leading-6 text-zinc-900">Last Name</label>
                    <div class="mt-2">
                        <input type="text" name="last_name" id="last_name" required 
                        class="block w-full rounded-md border-0 py-2.5 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-zinc-900 sm:text-sm sm:leading-6 transition-shadow">
                    </div>
                </div>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium leading-6 text-zinc-900">Email Address</label>
                <div class="mt-2">
                    <input type="email" name="email" id="email" required 
                    class="block w-full rounded-md border-0 py-2.5 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-zinc-900 sm:text-sm sm:leading-6 transition-shadow">
                </div>
            </div>

            <div class="grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-2">
                <div>
                    <label for="password" class="block text-sm font-medium leading-6 text-zinc-900">Password</label>
                    <div class="mt-2">
                        <input type="password" name="password" id="password" required 
                        class="block w-full rounded-md border-0 py-2.5 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-zinc-900 sm:text-sm sm:leading-6 transition-shadow">
                    </div>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium leading-6 text-zinc-900">Confirm</label>
                    <div class="mt-2">
                        <input type="password" name="password_confirmation" id="password_confirmation" required 
                        class="block w-full rounded-md border-0 py-2.5 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-zinc-900 sm:text-sm sm:leading-6 transition-shadow">
                    </div>
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" class="flex w-full justify-center rounded-md bg-zinc-900 px-3 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-zinc-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-zinc-900 transition-colors">
                    Create Account
                </button>
            </div>
        </form>

        <p class="mt-8 text-center text-sm text-zinc-500">
            Already have an account? 
            <a href="{{ route('student.login') }}" class="font-semibold text-zinc-900 hover:text-zinc-700 hover:underline">Sign in</a>
        </p>
        
        <p class="mt-4 text-center text-xs text-zinc-400">
            <a href="{{ route('welcome') }}" class="hover:text-zinc-600 transition-colors">&larr; Back to home</a>
        </p>
    </div>
</body>
</html>
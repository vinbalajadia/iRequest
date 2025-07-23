<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans">

    <div class="min-h-screen flex flex-col">
        <!-- Navbar -->
        <nav class="bg-white shadow-md px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-green-600">iRequest</h1>
            <div class="flex items-center gap-4">
                <span class="text-gray-700">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">Logout</button>
                </form>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Welcome, {{ Auth::user()->name }}</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Request Document Card -->
                <a href="{{ route('request.create') }}" class="bg-white shadow rounded p-5 hover:shadow-lg transition">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Request a Document</h3>
                    <p class="text-gray-600">Submit a request for TOR, Certificate, or Good Moral.</p>
                </a>

                <!-- My Requests Card -->
                <a href="{{ route('my.request') }}" class="bg-white shadow rounded p-5 hover:shadow-lg transition">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">My Requests</h3>
                    <p class="text-gray-600">View status of your requested documents.</p>
                </a>
            </div>
        </main>
    </div>

</body>
</html>

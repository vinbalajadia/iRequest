<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>iRequest | Student Document Request System</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-green-600">iRequest</h1>
            <div>
                <a href="{{ route('login') }}" class="text-green-600 hover:text-green-800 font-medium mr-4">Login</a>
                <a href="{{ route('register') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Register</a>
            </div>
        </div>
    </nav>

    <header class="text-center py-24 bg-gradient-to-b from-green-100 to-white">
        <h2 class="text-4xl font-extrabold mb-4">Request Your School Documents Online</h2>
        <p class="text-lg text-gray-600 mb-6">Fast. Easy. Paperless. All in one place.</p>
        <a href="{{ route('login') }}" class="bg-green-600 text-white px-6 py-3 rounded-full text-lg hover:bg-green-700">
            Get Started
        </a>
    </header>

    <section class="max-w-5xl mx-auto px-4 py-16">
        <div class="grid md:grid-cols-3 gap-8 text-center">
            <div>
                <div class="text-green-600 text-4xl mb-2">📄</div>
                <h3 class="text-xl font-bold mb-2">Request Easily</h3>
                <p class="text-gray-600">Select the document type, enter details, and submit — all online.</p>
            </div>
            <div>
                <div class="text-green-600 text-4xl mb-2">⏱️</div>
                <h3 class="text-xl font-bold mb-2">Save Time</h3>
                <p class="text-gray-600">No more long lines or paperwork. Submit in minutes.</p>
            </div>
            <div>
                <div class="text-green-600 text-4xl mb-2">📬</div>
                <h3 class="text-xl font-bold mb-2">Track Your Requests</h3>
                <p class="text-gray-600">See request status and get updates in real-time.</p>
            </div>
        </div>
    </section>

    <footer class="bg-gray-100 text-center py-6 text-sm text-gray-500">
    <div class="flex justify-center space-x-6 mb-2">
        <a href="https://facebook.com/balajadia.tristan" target="_blank" class="text-gray-600 hover:text-green-600">
            <svg class="w-6 h-6 inline-block" fill="currentColor" viewBox="0 0 24 24">
                <path d="M22 12c0-5.522-4.478-10-10-10S2 6.478 2 12c0 4.991 3.657 9.128 8.438 9.879v-6.987h-2.54v-2.892h2.54V9.797c0-2.507 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562v1.875h2.773l-.443 2.892h-2.33v6.987C18.343 21.128 22 16.991 22 12z"/>
            </svg>
        </a>

        <a href="https://instagram.com/vintristan_" target="_blank" class="text-gray-600 hover:text-green-600">
            <svg class="w-6 h-6 inline-block" fill="currentColor" viewBox="0 0 24 24">
                <path d="M7.75 2h8.5C19.55 2 22 4.45 22 7.75v8.5C22 19.55 19.55 22 16.25 22h-8.5C4.45 22 2 19.55 2 16.25v-8.5C2 4.45 4.45 2 7.75 2zm0 2C5.68 4 4 5.68 4 7.75v8.5C4 18.32 5.68 20 7.75 20h8.5C18.32 20 20 18.32 20 16.25v-8.5C20 5.68 18.32 4 16.25 4h-8.5zM12 7a5 5 0 110 10 5 5 0 010-10zm0 2a3 3 0 100 6 3 3 0 000-6zm4.5-2a1 1 0 110 2 1 1 0 010-2z"/>
            </svg>
        </a>

        <a href="https://github.com/vinbalajadia" target="_blank" class="text-gray-600 hover:text-green-600">
            <svg class="w-6 h-6 inline-block" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 0C5.37 0 0 5.37 0 12c0 5.3 3.438 9.8 8.205 11.387.6.113.82-.263.82-.582 0-.288-.012-1.243-.018-2.25-3.338.724-4.042-1.61-4.042-1.61-.546-1.387-1.333-1.756-1.333-1.756-1.09-.745.082-.729.082-.729 1.205.085 1.84 1.238 1.84 1.238 1.07 1.834 2.807 1.304 3.492.997.108-.775.418-1.304.762-1.604-2.665-.304-5.467-1.332-5.467-5.93 0-1.31.468-2.382 1.236-3.222-.124-.303-.536-1.527.116-3.176 0 0 1.008-.322 3.3 1.23a11.5 11.5 0 013.006-.404c1.02.005 2.047.137 3.006.404 2.29-1.552 3.295-1.23 3.295-1.23.655 1.65.243 2.873.12 3.176.77.84 1.235 1.912 1.235 3.222 0 4.61-2.807 5.625-5.48 5.922.43.372.823 1.104.823 2.225 0 1.606-.015 2.902-.015 3.293 0 .322.216.698.825.58C20.565 21.796 24 17.3 24 12c0-6.63-5.37-12-12-12z"/>
            </svg>
        </a>
    </div>

    <p>&copy; {{ date('Y') }} iRequest. All rights reserved.</p>
</footer>


</body>
</html>

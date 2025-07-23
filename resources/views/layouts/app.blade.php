<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>iRequest</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    @include('layouts.navbar')
    <div class="container mx-auto px-4">
        @yield('content')
    </div>
</body>
</html>

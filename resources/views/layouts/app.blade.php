<!DOCTYPE html>
<html>
<head>
    <br>
    <title> Student Management System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <header>
        <h1 class="text-center">Student Management System</h1>
    </header>

    <main class="container">
        @yield('content')
    </main>

    <footer class="text-center">
        <p>&copy; {{ date('Y') }} Student Management System</p>
    </footer>
</body>

</html>
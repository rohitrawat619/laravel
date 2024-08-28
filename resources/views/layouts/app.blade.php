<!DOCTYPE html>
<html>

<head>
    <br>
    <title> Student Management System</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <!-- DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" href="{{ asset('./resources/css/app.css') }}">
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
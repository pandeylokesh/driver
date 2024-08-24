<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Driver Management')</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Driver Management</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <!-- Driver Links -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('driver.create') }}">Add Driver</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('driver.index') }}">Driver List</a>
                    </li>
                    
                    <!-- Company Links -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('company.create') }}">Add Company</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('company.index') }}">Company List</a>
                    </li>

                    <!-- Booking Links -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('booking.create') }}">Add Booking</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('booking.index') }}">Booking List</a>
                    </li>

                    <!-- Partner Links -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('partner.create') }}">Add Partner</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('partner.index') }}">Partner List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('driver.login') }}">Driver Booking</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <main class="container mt-4">
        @yield('content')
    </main>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

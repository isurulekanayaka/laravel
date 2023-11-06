<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .sidebar {
            background-color: #343a40;
            color: #ffffff;
        }
        .sidebar a {
            color: #ffffff;
        }
        .sidebar a:hover {
            color: #ffffff;
        }
        .main-content {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    @include('layouts.adminnav')   
    @if(Auth::check())
    <h1 class="mb-4">Welcome Admin, {{ Auth::user()->name }}</h1>
    <div class="container-fluid mt-4">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-dark sidebar">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Products
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Orders
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Customers
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <h1 class="h2 mt-4">Dashboard</h1>
                <!-- Content for the dashboard goes here -->
                <p>Welcome to the Admin Dashboard.</p>
                <p>Here, you can manage products, orders, and customers.</p>
                <p></p>
                {{-- @foreach ($users as $user)
                @dd($user); // Check if $user contains the expected data                 
                @endforeach --}}
            </main>
        </div>
    </div>
    @else
    @php
        header("Location: /login");
        exit();
    @endphp
@endif
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

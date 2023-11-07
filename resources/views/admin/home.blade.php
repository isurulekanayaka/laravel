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
        .table {
            margin-top: 20px; /* Add margin to the top of the table */
            margin-bottom: 20px; /* Add margin to the bottom of the table */
            padding: 10px; /* Add padding inside the table */
        }
    </style>
</head>
<body>
    @include('layouts.adminnav')   
    @if(Auth::check())
    @if(Auth::user()->user_type == 'admin')
    <h1 class="mb-4">Welcome {{Auth::user()->user_type}}, {{ Auth::user()->name }}</h1>
    <div class="container-fluid mt-4">
        <div class="row">
            
            <main class="col-md-12 ms-sm-auto col-lg-12 px-md-4 main-content">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h2 mt-4">Dashboard</h1>
                    <form action="{{ route('admin.adduser') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">Add User</button>
                    </form>                    
                </div>
            </main>
            

            <br><br><br>

            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>User Type</th>
                        <th>Action</th><th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <form action="{{ route('update-user', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <td>
                                    <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                                </td>
                                <td>
                                    <input type="text" name="email" value="{{ $user->email }}" class="form-control">
                                </td>
                                <td>
                                    <input type="text" name="user_type" value="{{ $user->user_type }}" class="form-control">
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="#" onclick="deleteUser({{ $user->id }})" class="btn btn-danger">Delete</a>
                                </td>
                            </form>
                        </tr>
                    @endforeach
                </tbody>
            </table>
                
            <script>
                function deleteUser(userId) {
                    if (confirm("Are you sure you want to delete this user?")) {
                        // Send a DELETE request using JavaScript fetch API
                        fetch(`/delete-user/${userId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert('User deleted successfully');
                                location.reload(); // Refresh the page
                            } else {
                                alert('Error deleting user');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                    }
                }
            </script>
        </div>
    </div>@else
    @php
        header("Location: /login");
        exit();
    @endphp@endif
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

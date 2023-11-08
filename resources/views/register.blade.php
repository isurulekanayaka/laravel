<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Creative Register Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .register-container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        .register-container h2 {
            font-size: 32px;
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 20px;
            margin-bottom: 20px;
            padding: 10px 20px;
        }

        .btn-register {
            background-color: #007bff;
            border: none;
            border-radius: 20px;
            color: #ffffff;
            font-size: 18px;
            padding: 10px 40px;
            transition: background-color 0.3s;
        }

        .btn-register:hover {
            background-color: #0056b3;
        }

        .footer {
            margin-top: 30px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <strong>{{$message}}</strong>
            </div>
        @endif
        <h2>Register</h2>
        <form action="/signup" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Full Name" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="form-group">
                <select name="user_type" class="form-control" required>
                    <option value="user">User</option>
                    {{-- <option value="admin">Admin</option> --}}
                </select>
            </div>
            
            <button type="submit" class="btn btn-register">Register</button>
        </form>
        <p class="footer">Already have an account? <a href="{{route('login')}}">Login</a></p>
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

@include('layouts.usernav')

<div class="container mt-5">
    @if(Auth::check())
    <h1 class="mb-4">Welcome, {{ Auth::user()->name }}</h1>
    <h2>Write a Post</h2>
    <form action="{{ route('post') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="postTitle">Title</label>
            <input type="text" id="postTitle" name="postTitle" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="postBody">Body</label>
            <textarea id="postBody" name="postBody" class="form-control" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
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

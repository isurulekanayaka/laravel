<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @include('layouts/usernav')
    <div class="container mt-5">
        @if(Auth::check())
            <form action="{{ route('search') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" class="form-control" name="query" placeholder="Search...">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>
            
            <table class="table">
                <!-- Table headers go here -->
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Mail</th>
                        <th>Post title</th>
                        <th>Post Body</th>
                    </tr>
                </thead>
                <tbody>
                    @if($results !== null)
                        @foreach($results as $result)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $result->user->name }}</td>
                                <td>{{ $result->user->email }}</td>
                                <td>{{ $result->title }}</td>
                                <td>{{ $result->body }}</td>
                            </tr>
                        @endforeach
                    @else
                        <?php $iteration = 1; ?>
                        @foreach($users as $user)
                            @foreach($user->posts as $post)
                                <tr>
                                    <td>{{ $iteration++ }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->body }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    @endif
                </tbody>                               
            </table>
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
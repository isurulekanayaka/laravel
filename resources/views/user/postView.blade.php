<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Post View</title>
</head>
<body>  
    @if(Auth::check())
    @include('layouts.usernav')
    <div class="container mt-5">
    <h3> Post View</h3>
    <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Title</th>
                    <th>Body</th>
                    <th>Action</th>
                </tr>
            </thead>
    @foreach ($post as $post)
    <form action="{{ route('update-post', $post->id) }}" method="POST">
        @csrf
        @method('PUT')
        
            <tbody>
                    <tr>
                        <td>
                            <div class="form-group">
                                <label for="title{{ $post->id }}">Title</label>
                                <input type="text" class="form-control" id="title{{ $post->id }}" name="title" value="{{ $post->title }}">
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label for="body{{ $post->id }}">Body</label>
                                <textarea class="form-control" id="body{{ $post->id }}" name="body" rows="5">{{ $post->body }}</textarea>
                            </div>
                        </td>
                        
                        <td>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <a href="{{ url('/delete-post', $post->id) }}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
            </tbody>
        
        {{-- <button type="submit" class="btn btn-primary">Save Changes</button> --}}
        
    </form> @endforeach </table>  
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

@extends('master')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                <h2>All Posts</h2>
                @can('viewAny', App\Models\Post::class)
                    <a href="{{ route('posts.create') }}" class="btn btn-primary">Create Post</a>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                    <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Content</th>
            
            @can('viewAny', App\Models\Post::class)
            <th>Actions</th>
            @endcan
        </tr>
        @foreach($posts as $post)
        <tr>
            <td>{{ $post->title }}</td>
            <td>{{ $post->user->name }}</td>
            <td>{{ $post->content }}</td>
        
            @can('viewAny', App\Models\Post::class)
            <td>
                <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
                </td>
                @endcan
            
        </tr>
        @endforeach
                    </table>
                    {{ $posts->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

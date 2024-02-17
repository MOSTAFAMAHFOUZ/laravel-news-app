@extends('inc.app')

@section('content')
    <div class="col-12">
        <a href="{{ route('posts.create') }}" class="btn btn-primary my-3">Add New Post</a>
        <h1 class="text-center p-2 my-3 border">View All Posts To Admin</h1>
        @if (session()->get('success') !== null)
            <div class="alert alert-success p-1">
                {{ session()->get('success') }}
            </div>
        @endisset
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td>#</td>
                    <td>Title</td>
                    <td>Description</td>
                    <td>User</td>
                    <td>Tags</td>
                    <td>Edit</td>
                    <td>Delete</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ \Str::limit($post->description, 50) }}</td>
                        <td>{{ $post->user->name }}</td>
                        <td>
                            @foreach ($post->tags as $tag)
                                <span class="badge bg-success">{{ $tag->name }}</span>
                                <br>
                            @endforeach
                        </td>
                        <td>
                            {{-- @can('update', $post) --}}
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info" id="">Edit</a>
                            {{-- @endcan --}}
                        </td>
                        <td>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" id="">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $posts->links() }}
</div>
@endsection

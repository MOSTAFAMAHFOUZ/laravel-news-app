@extends('inc.app')

@section('content')
    <div class="col-12">
        <a href="{{ route('tags.create') }}" class="btn btn-primary my-3">Add New Tag</a>
        <h1 class="text-center p-2 my-3 border">View All Tags</h1>
        @if (session()->get('success') !== null)
            <div class="alert alert-success p-1">
                {{ session()->get('success') }}
            </div>
        @endisset
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td>#</td>
                    <td>Name</td>
                    <td>Posts</td>
                    <td>Edit</td>
                    <td>Delete</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($tags as $tag)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $tag->name }}</td>
                        <td>
                            @foreach ($tag->posts as $post)
                                <span class="badge bg-warning m-1">{{ $post->title }} </span>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-info" id="">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('tags.destroy', $tag->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" id="">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $tags->links() }}
</div>
@endsection

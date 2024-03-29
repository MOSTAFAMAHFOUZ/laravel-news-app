@extends('inc.app')

@section('content')
    @if (count($posts))
        <div class="col-12">
            <h1 class="text-center border p-2 my-3">View All Posts To Users</h1>
        </div>
    @endif
    @forelse($posts as $post)
        <div class="col-12 my-3">
            <div class="card">
                <div class="card-header">
                    {{ $post->user->name }} - {{ $post->created_at->format('Y-m-d') }}
                </div>
                <div class="card-body">
                    <h5 class="card-title"> {{ $post->title }}</h5>
                    <p class="card-text"> {{ \Str::limit($post->description, 50) }}</p>
                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">Show More</a>
                </div>
            </div>
        </div>
    @empty
        <h3 class="text-center p-5 text-danger">No Posts Found</h3>
    @endforelse
    <div class="text-center">
        {{ $posts->links() }}
    </div>
@endsection

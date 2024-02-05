@extends('inc.app')

@section('content')
    <div class="col-12">
        <h1 class="text-center my-2  p-3">Edit Post</h1>
    </div>
    <div class="col-8 mx-auto">
        <form method="POST" action="{{ route('posts.update', $post->id) }}" class="form border p-3">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="">Post Title</label>
                <input type="text" value="{{ $post->title }}" name="title" class="form-control"
                    value="{{ old('title') }}">
            </div>
            <div class="mb-3">
                <label for="">Post Description</label>
                <textarea name="description" class="form-control">{{ $post->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="">User</label>
                <select name="user_id" class="form-control" id="">
                    @foreach ($users as $user)
                        <option @selected($user->id == $post->user_id) value="{{ $user->id }}"> {{ $user->name }} </option>
                    @endforeach
                </select>
            </div>
            <div class="my-3">
                <input type="submit" class="form-control bg-success text-white" value="save" />
            </div>
        </form>
    </div>
@endsection

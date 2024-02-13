@extends('inc.app')

@section('content')
    <div class="col-12">
        <h1 class="text-center my-2  p-3">Edit Post</h1>
    </div>
    <div class="col-8 mx-auto">
        <form method="POST" action="{{ route('posts.update', $post->id) }}" class="form border p-3"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @if ($errors->any())
                <div class="alert alert-danger p-1">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="">Post Title</label>
                        <input type="text" name="title" class="form-control" value="{{ $post->title }}">
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="">User</label>
                        <select name="user_id" class="form-control" id="">
                            @foreach ($users as $user)
                                <option @selected($user->id == $post->user_id) value="{{ $user->id }}"> {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="">Post Description</label>
                <textarea name="description" rows="7" class="form-control">{{ $post->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="">Tags</label>
                <select name="tags[]" multiple class="form-control">
                    @foreach ($tags as $tag)
                        <option @if ($post->tags->contains($tag)) selected @endif value="{{ $tag->id }}">
                            {{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="">Post Image</label>
                <input type="file" name="image" class="form-control">
            </div>
            <div class="my-3">
                <input type="submit" class="form-control bg-success text-white" value="save" />
            </div>
        </form>
    </div>
@endsection

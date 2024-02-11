@extends('inc.app')

@section('content')
    <div class="col-12">
        <h1 class="text-center my-2  p-3">Edit Tag</h1>
    </div>
    <div class="col-8 mx-auto">
        <form method="POST" action="{{ route('tags.update', $tag->id) }}" class="form border p-3">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="">Tag Name</label>
                <input type="text" value="{{ $tag->name }}" name="name" class="form-control"
                    value="{{ old('name') }}">
            </div>
            <div class="my-3">
                <input type="submit" class="form-control bg-success text-white" value="save" />
            </div>
        </form>
    </div>
@endsection

@extends('inc.app')

@section('content')

<div class="col-12">
    <h1 class="text-center my-2  p-3">Edit Post</h1>
</div>
<div class="col-8 mx-auto">
    <form action="POST" action="{{route('posts.update',1)}}" class="form border p-3">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="">Post Title</label>
            <input type="text" name="title" class="form-control" value="{{old('title')}}">
        </div>
        <div class="mb-3">
            <label for="">Post Description</label>
            <textarea  name="description" class="form-control" >{{old('description')}}</textarea>
        </div>
        <div class="mb-3">
            <label for="">User</label>
            <select  name="user_id" class="form-control" id="">
                <option value="1"> Ahmed </option>
                <option value="2"> Ali</option>
            </select>
        </div>
        <div class="my-3">
            <input type="submit"  name="description" class="form-control bg-success text-white" value="save" />
        </div>
    </form>
</div>

@endsection

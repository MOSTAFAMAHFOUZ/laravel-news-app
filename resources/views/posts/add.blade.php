@extends('inc.app')

@section('content')

<div class="col-12">
    <h1 class="text-center my-2  p-3">Add New Post</h1>

</div>
<div class="col-8 mx-auto">
    <form method="POST" action="{{route('posts.store')}}" class="form border p-3">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger p-1">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session()->get('success') !== null)
            <div class="alert alert-success p-1">
                {{session()->get('success')}}
            </div>
        @endisset
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
                @foreach($users as $user)
                <option value="{{$user->id}}"> {{$user->name}} </option>
                @endforeach
            </select>
        </div>
        <div class="my-3">
            <input type="submit"   class="form-control bg-success text-white" value="save" />
        </div>
    </form>
</div>

@endsection

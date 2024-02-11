@extends('inc.app')

@section('content')
    <div class="col-12">
        <h1 class="text-center my-2  p-3">Add New User</h1>

    </div>
    <div class="col-8 mx-auto">
        <form method="POST" action="{{ route('users.store') }}" class="form border p-3">
            @csrf
            @include('inc.message')
            <div class="mb-3">
                <label for="">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
            </div>
            <div class="mb-3">
                <label for="">Email</label>
                <input type="text" name="email" class="form-control" value="{{ old('email') }}">
            </div>
            <div class="mb-3">
                <label for="">Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="mb-3">
                <label for="">Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control">
            </div>
            <div class="mb-3">
                <label for="">User Type</label>
                <select name="type" class="form-control">
                    <option value="admin" @selected('admin' == old('type'))>Admin</option>
                    <option value="writer" @selected('writer' == old('type'))>Writer</option>
                </select>
            </div>
            <div class="my-3">
                <input type="submit" class="form-control bg-success text-white" value="save" />
            </div>
        </form>
    </div>
@endsection

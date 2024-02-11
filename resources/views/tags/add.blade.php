@extends('inc.app')

@section('content')
    <div class="col-12">
        <h1 class="text-center my-2  p-3">Add New Tag</h1>

    </div>
    <div class="col-8 mx-auto">
        <form method="POST" action="{{ route('tags.store') }}" class="form border p-3">
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
            @if (session()->get('success') !== null)
                <div class="alert alert-success p-1">
                    {{ session()->get('success') }}
                </div>
            @endisset
            <div class="mb-3">
                <label for="">Tag Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
            </div>

            <div class="my-3">
                <input type="submit" class="form-control bg-success text-white" value="save" />
            </div>
    </form>
</div>
@endsection

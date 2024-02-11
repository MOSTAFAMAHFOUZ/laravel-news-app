@extends('inc.app')

@section('content')
    <div class="col-12">
        <a href="{{ route('users.create') }}" class="btn btn-primary my-3">Add New User</a>
        <h1 class="text-center p-2 my-3 border">View All Users</h1>
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
                    <td>Email</td>
                    <td>Type</td>
                    <td>Edit</td>
                    <td>Delete</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->type }}</td>
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info" id="">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" id="">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
</div>
@endsection

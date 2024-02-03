@extends('inc.app')

@section('content')


    <div class="col-12">
        <a href="{{route('posts.create')}}" class="btn btn-primary my-3">Add New Post</a>
        <h1 class="text-center p-2 my-3 border">View All Posts To Admin</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td>#</td>
                    <td>Title</td>
                    <td>Description</td>
                    <td>User</td>
                    <td>Edit</td>
                    <td>Delete</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>First Post</td>
                    <td>First Description for The Post</td>
                    <td>Mostafa</td>
                    <td>
                        <a href="{{route('posts.edit',1)}}" class="btn btn-info" id="">Edit</a>
                    </td>
                    <td>
                        <form action="{{route('posts.destroy',1)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" id="">Delete</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


@endsection

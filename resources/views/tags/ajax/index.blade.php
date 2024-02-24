@extends('inc.app')

@section('content')
    <div class="col-12">
        <a href="{{ route('ajax-tags.create') }}" class="btn btn-primary my-3">Add New Tag</a>
        <div id="show-message" class="text-center alert alert-success d-none"></div>

        <h1 class="text-center p-2 my-3 border">View All Tags</h1>
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
                    <td>Posts</td>
                    <td>Edit</td>
                    <td>Delete</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($tags as $tag)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $tag->name }}</td>
                        <td>
                            @foreach ($tag->posts as $post)
                                <span class="badge bg-warning m-1">{{ $post->title }} </span>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('ajax-tags.edit', $tag->id) }}" class="btn btn-info" id="">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('ajax-tags.destroy', $tag->id) }}" method="post"  class="delete-tag">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" id="">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $tags->links() }}
</div>
@endsection


@section('script')

    <script>
        let items = document.querySelectorAll(".delete-tag");
        let showMessageEl = document.getElementById("show-message");

        items.forEach(element => {
            element.addEventListener("submit",function(e){
                e.preventDefault();
            let token = element.querySelector("input[name='_token']").value;
            fetch(element.action,{
                method:"DELETE",
                headers:{
                    "Content-Type":"application/json",
                    "Accept":"application/json",
                    "X-CSRF-TOKEN":token
                }
            })
            .then(res=>res.json())
            .then(data=>{
                showMessageEl.classList.remove("d-none");
                showMessageEl.classList.add("d-block");
                if(data['status'] != null){
                    showMessageEl.textContent = data.message;
                    showMessageEl.classList.remove("alert-danger")
                    showMessageEl.classList.add("alert-success")
                    element.closest("tr").remove();
                }else{
                    showMessageEl.classList.remove("alert-success")
                    showMessageEl.classList.add("alert-danger")
                    showMessageEl.textContent = data.message
                }
            })
            })


        });
    </script>

@endsection

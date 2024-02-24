@extends('inc.app')

@section('content')
    <div class="col-12">
        <h1 class="text-center my-2  p-3">Edit Tag</h1>
    </div>
    <div class="col-8 mx-auto">
        <form method="POST" action="{{ route('ajax-tags.update', $tag->id) }}" class="form border p-3 " id="update-tag">
            <div id="show-message" class="text-center alert alert-success d-none"></div>
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


@section('script')

    <script>

        let el = document.getElementById("update-tag");

        el.addEventListener("submit",function(e){
            e.preventDefault();
            let action = el.action;
            let data = new FormData(el);
            let name  = data.get("name");
            let token = data.get("_token");
            let showMessageEl = document.getElementById("show-message");
            let input = document.querySelector("input[name='name']");


            // return false;
            fetch(action,{
                method:"PUT",
                headers:{
                    "Content-Type": "application/json",
                    "Accept":"application/json",
                    'X-CSRF-TOKEN':token
                },
                body:JSON.stringify({"name":name})
            }).then(res=>res.json())
            .then(data=>{
                showMessageEl.classList.remove("d-none");
                showMessageEl.classList.add("d-block");
                if(data['status'] != null){
                    showMessageEl.textContent = data.message;
                    showMessageEl.classList.remove("alert-danger")
                    showMessageEl.classList.add("alert-success")
                }else{
                    showMessageEl.classList.remove("alert-success")
                    showMessageEl.classList.add("alert-danger")
                    showMessageEl.textContent = data.message
                }
            })
        });
    </script>

@endsection


@extends('inc.app')

@section('content')


    <div class="col-12">
        <h1 class="text-center border p-2 my-3">View All Posts To Users</h1>

    </div>
    @foreach ($posts as $post)

    <div class="col-12 my-3">
        <div class="card">
            <div class="card-header">
              {{$post->user->name}} - {{$post->created_at->format('Y-m-d')}}
            </div>
            <div class="card-body">
              <h5 class="card-title"> {{$post->title}}</h5>
              <p class="card-text"> {{\Str::limit($post->description,50)}}</p>
              <a href="{{route('posts.show',$post->id)}}" class="btn btn-primary">Show More</a>
            </div>
          </div>
    </div>
    @endforeach
    <div class="text-center">
        {{$posts->links()}}
    </div>


@endsection

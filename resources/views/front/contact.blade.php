@extends('inc.app')

@section('content')
    <div class="col-6 mx-auto">
        <h1>Send Message</h1>
        <form action="{{route('front.send-message')}}" method="POST" class="form border p-3 my-4">
            @csrf
            @if (session()->get('success') !== null)
            <div class="alert alert-success p-1">
                {{ session()->get('success') }}
            </div>
        @endisset
            <div class="mb-3">
                <label for="">Name</label>
                <input type="text" name="name" class="form-control" />
            </div>
            <div class="mb-3">
                <label for="">Email</label>
                <input type="text" name="email" class="form-control" />
            </div>
            <div class="mb-3">
                <label for="">Message</label>
                <textarea type="text" name="message" class="form-control" ></textarea>
            </div>
            <div class="mb-3">
                <input type="submit" class="form-control bg-success text-white " value="Send Message" />
            </div>
        </form>
    </div>
@endsection

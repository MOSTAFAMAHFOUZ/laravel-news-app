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

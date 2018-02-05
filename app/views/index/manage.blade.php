@extends("_tmp.main")

@section("content")
    <h1>From Index</h1>

    @foreach ($names as $name)
        <p>This is user {{ $name }}</p>
    @endforeach

@endsection
@extends("_tmp.main")

@section('title') Timino | Index @endsection

@section("content")
    <h1>From Index</h1>

    @foreach ($names as $name)
        <p>This is user {{ $name }}</p>
    @endforeach

@endsection
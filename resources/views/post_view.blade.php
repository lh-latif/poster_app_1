@extends("layouts.main")

@section("body")
  <div>
    <h1>{{$post->title}}</h1>
    <p>{{$post->content}}</p>
  </div>
@endsection

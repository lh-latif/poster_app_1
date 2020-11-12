@extends("layouts.main")

@section("body")
  <div class="my-3">
    <div class="my-2">
      <h1>{{$post->title}}</h1>
    </div>
    <div>{!! $post->content !!}</div>
  </div>
@endsection

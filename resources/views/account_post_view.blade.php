@extends("layouts.main")

@section("body")
  <div class="mt-5 mb-4">
    <h1 class="display-4">{{$post->title}}</h1>
    <p>dibuat {{$post->created_at}}</p>
    <a class="btn btn-primary" href="/account/post/{{$post->id}}/edit">
      Edit
    </a>
  </div>
  <p>{{$post->content}}</p>
@endsection

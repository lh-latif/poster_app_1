@extends("layouts.main")

@section("body")
  <div class="my-3">
    <a class="btn btn-primary" href="/login">
      Login
    </a>
    <a class="btn btn-primary" href="/register">
      Register
    </a>
  </div>
  <div>
    <h1 class="mt-5 mb-4 display-4">List Post</h1>
    @if (sizeof($posts) == 0)
      <p>Tidak ada post yang dirilis</p>
    @else
      <ol>
      @foreach($posts as $post)
        <li>
          <a href="/posts/{{$post->id}}">
            {{$post->title}}
          </a>
        </li>
      @endforeach
      </ol>
    @endif
  </div>
@endsection

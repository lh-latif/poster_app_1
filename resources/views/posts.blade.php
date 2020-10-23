@extends("layouts.main")

@section("body")
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

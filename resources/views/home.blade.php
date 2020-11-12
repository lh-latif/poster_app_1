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
          <div class="card card-body post-list-card" >
            <a href="/posts/{{$post->id}}">
              {{$post->title}}
            </a>
          </div>
        </li>
      @endforeach
      </ol>
      <div>
        @for ($i = 1;$i <= $pagination;$i++)
          @if ($i == $page)
            <span>{{$i}}</span>
          @else
            <a href="/?page={{$i}}">{{$i}}</a>
          @endif
        @endfor
      </div>
    @endif
  </div>
@endsection

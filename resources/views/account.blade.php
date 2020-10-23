@extends("layouts.main")

@section("body")
  <div class="my-5">
    <h1>Halo {{$user->name}}</h1>

    <a href="/account/add_post" class="btn btn-primary">
      Buat Post Baru
    </a>
  </div>

  <div class="card">
    <h2 class="card-header">Posts Tersimpan</h2>
    <div class="card-body">
      @if (sizeof($posts) == 0)
        <p>Tidak ada post yang tersimpan</p>
      @else
        <ol>
        @foreach($posts as $post)
          <li>
            <a href="account/post/{{$post->id}}">
              {{$post->title}}
            </a>
          </li>
        @endforeach
        </ol>
      @endif
    </div>
  </div>
@endsection

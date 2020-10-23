@extends("layouts.main")

@section("body")
  <div class="my-3">
    <h1 class="mt-2">Login</h1>
    <a href="/register" class="btn">
      Register
    </a>
  </div>

  <form action="/login" method="POST">
    @csrf
    <div class="form-group">
      <label>Email</label>
      <input class="form-control" type="text" name="email">
    </div>

    <div class="form-group">
      <label>Password</label>
      <input class="form-control" type="password" name="password">
    </div>

    <input class="btn btn-primary" type="submit" value="Login">
  </form>
@endsection

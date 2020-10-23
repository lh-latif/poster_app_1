@extends("layouts.main")

@section("body")
  <div class="my-3">
    <h1 class="mb-2">Register</h1>
    <a href="/login" class="btn">
      Login
    </a>
  </div>


  <form method="POST" action="/register">
    @csrf
    <div class="form-group">
      <label>Name</label>
      <input class="form-control" type="text" name="name" >
    </div>

    <div class="form-group">
      <label>Email</label>
      <input class="form-control" type="text" name="email" >
    </div>

    <div class="form-group">
      <label>Password</label>
      <input class="form-control" type="password" name="password" >
    </div>

    <input class="btn btn-primary" type="submit" value="Register"/>
  </form>
@endsection

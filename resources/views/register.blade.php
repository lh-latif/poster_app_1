@extends("layouts.main")

@section("body")
  <h1>Register</h1>
  <form method="POST" action="/register">
    @csrf
    <label>
      Name
    </label>
    <input type="text" name="name" >
    <label>
      Email
    </label>
    <input type="text" name="email" >
    <label>
      Password
    </label>
    <input type="password" name="password" >
    <input type="submit" value="register"/>
  </form>
@endsection

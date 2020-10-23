@extends("layouts.main")

@section("body")
  <form action="/login" method="POST">
    @csrf
    <input type="text" name="email">
    <input type="password" name="password">
    <input type="submit">
  </form>
@endsection

<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LoginController {
  public static function show(Request $req) {
    $req->session()->put("cat","miauww");
    return view("login");
  }

  public static function submit(Request $req) {
    $data = $req->validate([
      "email" => ["email"],
      "password" => ["string","min:6"]
    ]);
    $user = User::verify_user(
        $data["email"],
        $data["password"]
      );
    $req->session()->put("usk",$user->id);
    return redirect("/account");
  }
}

?>

<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\UserPassword;

class RegisterController {
  public static function show() {
    return view("register");
  }

  public static function submit(Request $req) {
    $data = $req->validate([
      "name" => ["string","required"],
      "password" => ["string","required","min:6","max:20"],
      "email" => ["string","email","required"]
    ]);
    User::add_user_and_password(
       $data["name"],
       $data["email"],
       $data["password"]
     );

  }
}

?>

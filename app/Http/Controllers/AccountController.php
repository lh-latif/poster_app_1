<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User,Post};

class AccountController {
  public static function show(Request $req) {
      $user = $req->user;
      $posts = Post::list_post_by_user($user->id);
      return view("account",["user" => $user, "posts" => $posts]);
  }
}

?>

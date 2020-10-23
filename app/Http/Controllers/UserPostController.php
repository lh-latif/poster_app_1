<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User,Post};

class UserPostController {
  public static function add() {
    return view("account_post");
  }

  public static function show(Request $req,$id) {
    $user = $req->user;
    $post = Post::get_post_by_user($id,$user->id);
    return view("account_post_view",["post" => $post]);
  }

  public static function submit(Request $req) {
    $data = $req->validate([
      "title" => ["string","min:3"],
      "content" => ["string","min:3"]
    ]);
    $user = $req->user;
    Post::add_post($data["title"],$data["content"],$user->id);
    // return redirect("/account");
  }
}
?>

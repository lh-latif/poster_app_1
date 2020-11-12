<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User,Post};
use League\CommonMark\CommonMarkConverter;


class UserPostController {
  private static $columns = [
    "title" => ["string","min:3"],
    "content" => ["string","min:3"]
  ];

  public static function add() {
    return view("account_post");
  }

  public static function show(Request $req,$id) {
    $user = $req->user;
    $post = Post::get_post_by_user($id,$user->id);
    $converter = new CommonMarkConverter();
    $post->content = $converter->convertToHtml($post->content);
    return view("account_post_view",["post" => $post]);
  }

  public static function submit(Request $req) {
    $data = $req->validate(self::$columns);
    try {
      // $post = Post::add_post($data["title"],$data["content"],$req->user->id);
      return redirect("/account");
    } catch(Exception $e) {
      return response("",422);
    }
  }

  public static function edit(Request $req) {
    return view("account_post_edit",["post" => $req->post]);
  }

  public static function edit_submit(Request $req) {
    $data = $req->validate(self::$columns);
    $post = Post::edit_post($req->post,$data["title"],$data["content"]);
    if ($post === false) {
      return response("",422);
    } else {
      return redirect("/account/post/".$post->id);
    }
  }

  public static function delete(Request $req) {
    try {
      Post::delete_post($req->post);
      return redirect("/account");
    } catch(Exception $e) {
      return response("error",422);
    }
  }
}
?>

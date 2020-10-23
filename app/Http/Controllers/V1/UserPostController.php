<?php
namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Models\Post;

class UserPostController {
  private static $columns = [
    "title" => ["string","min:3"],
    "content" => ["string","min:3"]
  ];

  public static function index(Request $req) {
    return response()->json([
      "data" => Post::list_post_by_user($req->user->id)
    ]);
  }

  public static function get(Request $req,$id) {
    return response()->json([
      "data" => $req->post
    ]);
  }

  public static function add(Request $req) {
    $data = $req->validate(self::$columns);
    try {
      return response()->json([
        "data" => Post::add_post(
          $data["title"],
          $data["content"],
          $req->user->id
        )
      ]);
    } catch(Exception $e) {
      return response("",422);
    }

  }

  public static function edit(Request $req) {
    $data = $req->validate(self::$columns);
    $post = Post::edit_post($req->post,$data["title"],$data["content"]);
    if ($post == false) {
      return response("",422);
    } else {
      return response()->json([
        "data" => $post
      ]);
    }
  }

  public static function delete(Request $req) {
    $action = Post::delete_post($req->post);
    if ($action == false) {
      return response("",422);
    } else {
      return response("",204);
    }
  }

}

?>

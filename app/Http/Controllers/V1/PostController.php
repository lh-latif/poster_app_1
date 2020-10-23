<?php
namespace App\Http\Controllers\V1;

use App\Models\Post;

class PostController {
  public static function index() {
    return response()->json([
      "data" => Post::list_post()
    ]);
  }

  public static function show($id) {
    $post = Post::get_post($id);
    if (isset($post) && $post != false) {
      return response()->json([
        "data" => $post
      ]);
    } else {
      return response("",404);
    }
  }

}

?>

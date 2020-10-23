<?php
namespace App\Http\Controllers;

use App\Models\Post;

class PostController {
  public static function index() {
    $posts = Post::list_post();
    return view("posts",["posts" => $posts]);
  }

  public static function show($id) {
    $post = Post::get_post($id);
    return view("post_view",["post" => $post]);
  }
}

?>

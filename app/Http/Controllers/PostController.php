<?php
namespace App\Http\Controllers;

use App\Models\Post;
use League\CommonMark\CommonMarkConverter;

class PostController {
  public static function index() {
    $posts = Post::list_post();
    return view("posts",["posts" => $posts]);
  }

  public static function show($id) {
    $post = Post::get_post($id);
    $converter = new CommonMarkConverter();
    $post->content = $converter->convertToHtml($post->content);
    return view("post_view",["post" => $post]);
  }
}

?>

<?php
namespace App\Http\Controllers;

use App\Models\Post;

class HomeController {
  public static function show() {
    return view("home",["posts" => Post::list_post()]);
  }
}
?>

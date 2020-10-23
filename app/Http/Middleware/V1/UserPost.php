<?php
namespace App\Http\Middleware\V1;

use App\Models\Post;
use Closure;
use Illuminate\Http\Request;

class UserPost {
  /**
  * Middleware untuk mengecek entity post apakah milik user atau tidak
  *
  */
  public static function handle(Request $req, Closure $next, ...$guards) {
    $post = Post::get_post_by_user($req->id,$req->user->id);
    if (isset($post)) {
      $req->post = $post;
      return $next($req);
    } else {
      return response("",403);
    }
  }
}

?>

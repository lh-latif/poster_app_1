<?php
namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCounter;
use Illuminate\Http\Request;
use Requests;

class HomeController {
  private const PAGE_NUM = 3;

  public static function show(Request $req) {
    // $url = "http://admin:password@localhost:5984/post_comment/_design/add_comments/_update/add_comments/93064a1f1532e2a3cd8543148500163e";
    // $url1 = "http://admin:password@localhost:5984/post_comment/93064a1f1532e2a3cd8543148500163e";
    // $url2 = "http://localhost:4040";
    // $reqs = Requests::get(
    //     $url1,
    //     [],
    //     []
    // );
    // var_dump(json_decode($reqs->body));
    $page = $req->query("page");
    $post_counter = PostCounter::get_data();
    $post_sum = $post_counter->value;
    $pagination = ceil($post_sum / self::PAGE_NUM);
    $list_post;
    $current_page;
    if (isset($page) && ($page - 1) <= ($post_sum / self::PAGE_NUM)) {
        $current_page = $page;
        $page = $page - 1;
        $skip = $page * self::PAGE_NUM;
        $rest_post = $post_sum - $skip;
        if ($rest_post >= self::PAGE_NUM) {
            $list_post = Post::list_post_by_page($skip,self::PAGE_NUM);
        } else {
            $list_post = Post::list_post_by_page($skip,$rest_post);
        }
    } else {
        $current_page = 1;
        if ($post_sum <= self::PAGE_NUM) {
            $pagination = 1;
            $list_post = Post::list_post();
        } else {
            $list_post = Post::list_post_by_page(0,self::PAGE_NUM);
        }
    }

    return view("home",["posts" => $list_post, "pagination" => $pagination, "page" => $current_page]);
  }
}
?>

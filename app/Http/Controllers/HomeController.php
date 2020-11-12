<?php
namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCounter;
use Illuminate\Http\Request;

class HomeController {
  private const PAGE_NUM = 3;

  public static function show(Request $req) {
    $page = $req->query("page");
    $post_counter = PostCounter::get_data();
    $post_sum = $post_counter->value;
    $pagination = floor($post_sum / self::PAGE_NUM);
    $list_post;
    $current_page;
    if (isset($page) && ($page - 1) <= ($post_sum / self::PAGE_NUM)) {
        $current_page = $page;
        --$page;
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

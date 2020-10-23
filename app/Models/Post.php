<?php
namespace App\Models;

use App\Models\Post\Data;
use Exception;

class Post {
  public static function list_post() {
    return Data::get();
  }

  public static function get_post($id) {
    return Data::find($id);
  }

  public static function list_post_by_user($user_id) {
    return Data::where("user_id",$user_id)->get();
  }

  public static function get_post_by_user($id,$user_id) {
    return Data::where("user_id",$user_id)->where("id",$id)->first();
  }

  public static function add_post($title,$content,$user_id) {
    $post = new Data();
    $post->title = $title;
    $post->content = $content;
    $post->user_id = $user_id;
    if ($post->save()) {
      return $post;
    } else {
      throw new Exception("Failed");
    }
    // return $post;
  }

  public static function edit_post($post,$title,$content) {
    $post->title = $title;
    $post->content = $content;
    if ($post->save()) {
      return $post;
    } else {
      return false;
    }
  }

  public static function delete_post($post) {
    return $post->delete();
  }

}


?>

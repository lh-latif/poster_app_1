<?php
namespace App\Models;

use App\Models\Counter;

class PostCounter {
  public static function get_data() {
    return Counter::get_counter("post_counter");
  }

  public static function a_post_added() {
      $data = self::get_data();
      $data->value += 1;
      $data->save();
  }

  public static function a_post_deleted() {
      $data = self::get_data();
      $data->value -= 1;
      $data->save();
  }
}

?>

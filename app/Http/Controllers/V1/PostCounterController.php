<?php
namespace App\Http\Controllers\V1;

use App\Models\PostCounter;

class PostCounterController {

  public static function index() {
    return response()->json(
      ["data" => PostCounter::get_data()]
    );
  }

}

?>

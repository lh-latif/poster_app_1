<?php
namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Password extends Model {
  protected $table = "user_word";
  protected $primaryKey = "user_id";
  public $timestamps = false;

  public static function get_table() {
    return "user_word";
  }

}

?>

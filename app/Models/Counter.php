<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Counter extends Model {
  protected $table = "counter";
  protected $fillable = [
    "key",
    "value"
  ];
  public $timestamps = false;

  public static function get_counter($key) {
    $data = self::where("key",$key)->first();
    if (isset($data)) {
      return $data;
    } else {
      $newData = new Counter();
      $newData->key = $key;
      $newData->value = 0;
      if ($newData->save()) {
        return $newData;
      } else {
        throw new Exception("Error");
      }
    }
  }
}

?>

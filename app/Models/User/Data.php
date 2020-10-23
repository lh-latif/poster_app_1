<?php
namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Data extends Model {
  protected static $tname = "user";
  protected $table;

  public function __construct() {
    parent::__construct();
    $this->table = self::$tname;
  }

  public static function get_table() {
    return self::$tname;
  }

}

?>

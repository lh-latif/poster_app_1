<?php
namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;

class Data extends Model {
  protected static $tname = "post";
  protected $table;

  public function __construct() {
    parent::__construct();
    $this->table = self::$tname;
  }
}

?>

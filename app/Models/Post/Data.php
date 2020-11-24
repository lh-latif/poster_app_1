<?php
namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;

class Data extends Model {
  protected static $tname = "post";
  protected $table;

  // public $timestamps = false;
  protected $primaryKey = "id";
  public $incrementing = false;
  protected $keyType = "string";

  public function __construct() {
    parent::__construct();
    $this->table = self::$tname;
  }
}

?>

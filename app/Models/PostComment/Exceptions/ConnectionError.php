<?php
namespace App\Models\PostComment\Exceptions;

class ConnectionError extends Exception {
    public function __construct() {
        parent::__construct("Connection to DB Error");
    }
}

?>

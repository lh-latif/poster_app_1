<?php
namespace App\Models\Execptions;

use Exception;

class EntityNotFound extends Exception {
    public function __construct() {
        parent::__construct("Entity Not Found");
    }
}
?>

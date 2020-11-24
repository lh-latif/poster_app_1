<?php
namespace App\Models;

class Result {
    protected function __construct($_result, $_value, $_exception) {
        $this->_result = $_result;
        $this->_value = $_value;
        $this->_exception = $_exception;
    }

    public function is_success() {
        return $this->_result;
    }

    public function is_error() {
        return !$this->_result;
    }

    public function unwrap() {
        if ($this->_result) {
            return $this->_value;
        } else {
            return $this->_exception;
        }
    }

    public static function success($value) {
        return new self(true, $value, null);
    }

    public static function error($exception) {
        return new self(false, null, $exception);
    }
}

?>

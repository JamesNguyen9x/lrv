<?php

namespace App\Exceptions;

use Exception;

class ValidateException extends Exception{
    protected $error;
    public function __construct($errors, $code=0, $previous=null) {
        $this->error = $errors;
        parent::__construct($errors, $code, $previous);
    }
    public function getErrors(){
        return $this->error;
    }
}

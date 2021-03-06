<?php

namespace App\Exceptions;

use Exception;

class NullException extends Exception{
    protected $error;
    
    public function __construct($errors, $code=0, $previous=null) {
        $this->error = $errors;
        parent::__construct($errors, $code, $previous);
    }
    public function getError(){
        return $this->error;
    }
}


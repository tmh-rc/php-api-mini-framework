<?php

namespace Core\Exceptions;

use Exception;

class ValidationException extends Exception
{
    protected $errors = [];

    public static function withMessage($errors)
    {
        $instance = new static();
        $instance->errors = $errors;

        return $instance;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}

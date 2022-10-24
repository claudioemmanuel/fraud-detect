<?php

namespace App\Exceptions;

use Exception;

class InvalidCpfException extends Exception
{
    public function __construct($message = 'Invalid CPF', $code = 400)
    {
        parent::__construct($message, $code);
    }
}

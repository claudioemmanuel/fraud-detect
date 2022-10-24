<?php

namespace App\Exceptions;

use Exception;

class NotAllowedAgeException extends Exception
{
    public function __construct($message = 'Client is not allowed to buy', $code = 400)
    {
        parent::__construct($message, $code);
    }
}

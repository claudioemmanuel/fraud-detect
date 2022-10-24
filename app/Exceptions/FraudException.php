<?php

namespace App\Exceptions;

use Exception;

class FraudException extends Exception
{
    public function __construct($message = 'Possible fraud detected', $code = 422)
    {
        parent::__construct($message, $code);
    }
}

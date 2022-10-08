<?php

namespace App\Curl;

use Exception;
use Throwable;

class CurlException extends Exception
{

    public function __construct($message = "", $code = 500, Throwable $previous = null)
    {
        $message = "Curl error: $message ($code)";

        parent::__construct($message, $code, $previous);
    }
}

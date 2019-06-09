<?php

namespace app\exceptions;

use Exception;

class InvalidAccessTokenException extends Exception
{
    public function __construct()
    {
        parent::__construct('Invalid access token', 0, null);
    }
}
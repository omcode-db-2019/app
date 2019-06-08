<?php

class QuotaExceededException extends Exception
{
    public function __construct()
    {
        parent::__construct('Request Quota has been exceeded', 0, null);
    }
}
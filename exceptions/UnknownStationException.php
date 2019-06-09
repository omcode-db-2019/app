<?php

namespace app\exceptions;

use app\models\Station;
use Exception;

class UnknownStationException extends Exception
{
    public function __construct(Station $station)
    {
        parent::__construct(\sprintf('Unknown monitoring station or city: "%s"', $station->endpoint), 0, null);
    }
}

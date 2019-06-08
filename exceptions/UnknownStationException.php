<?php


class UnknownStationException extends Exception
{
    public function __construct(string $station)
    {
        parent::__construct(\sprintf('Unknown monitoring station or city: "%s"', $station), 0, null);
    }
}

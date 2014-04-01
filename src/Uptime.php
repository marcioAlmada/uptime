<?php

namespace Uptime;

use DateInterval;

class Uptime extends DateInterval
{
    protected $seconds;

    public function __construct($time)
    {
        $this->seconds = (float) $time;
        list($days, $time)    = [(int) ($time / 86400), $time % 86400];
        list($hours, $time)   = [(int) ($time / 3600), $time % 3600];
        list($minutes, $time) = [(int) ($time / 60), $time % 60];
        $seconds = $time;
        parent::__construct("P{$days}DT{$hours}H{$minutes}M{$seconds}S");
    }

    public function __toString()
    {
        return (string) $this->seconds;
    }

    public function getRaw()
    {
        return $this->seconds;
    }

}

<?php

namespace Uptime\Runtime\Windows;

use Uptime\Runtime\RuntimeInterface;

use DateTime;

class Uptime implements RuntimeInterface
{

    public function read( RuntimeInterface $boottime = null )
    {
        $boottime = $boottime ? $boottime  : new Boottime();
        $now = new DateTime('now');
        $interval = $now->diff( new DateTime( '@' . $boottime->read() ) );
        return ($interval->y * 365 * 24 * 60 * 60) +
               ($interval->m * 30 * 24 * 60 * 60) +
               ($interval->d * 24 * 60 * 60) +
               ($interval->h * 60 * 60) +
               ($interval->i * 60) +
               ($interval->s);
    }
}
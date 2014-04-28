<?php

namespace Uptime\Runtime\OpenVMS;

use DateTime;
use Uptime\Runtime\RuntimeInterface;

class Boottime implements RuntimeInterface
{
    public function read( RuntimeInterface $uptime = null )
    {
        $uptime = $uptime ? $uptime : new Uptime();
        $time = new DateTime('now');
        $time->modify(sprintf('- %d seconds', $uptime->read()));

        return $time->getTimestamp();
    }
}
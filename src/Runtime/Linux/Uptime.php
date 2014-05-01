<?php

namespace Uptime\Runtime\Linux;

use Uptime\Runtime\RuntimeInterface;

class Uptime implements RuntimeInterface
{
    public function read($source = '/proc/uptime')
    {
        return (float) explode(' ', file_get_contents( $source ))[0];
    }
}

<?php

namespace Uptime\Runtime\OpenVMS;

use Uptime\Runtime\RuntimeInterface;

class Uptime implements RuntimeInterface
{
    public function read($command = 'sysctl kern.boottime')
    {
        preg_match_all('#(?<=Uptime).+#', shell_exec($command), $matches);
        $raw_uptime = $matches[0][0];
        list($d, $raw_time) = explode(' ', trim($raw_uptime));
        list($h, $i, $s) = explode(':', $raw_time);

        return ($d * 24 * 60 * 60) + ($h * 60 * 60) + ($i * 60) + $s;
    }
}

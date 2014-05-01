<?php

namespace Uptime\Runtime\Darwin;

use Uptime\Runtime\RuntimeInterface;

class Uptime implements RuntimeInterface
{
    public function read($command = 'sysctl kern.boottime')
    {
        preg_match_all('#(?<={)\s?sec\s?=\s?+\d+#', shell_exec($command), $matches);

        return (float) explode('=', $matches[0][0])[1];
    }
}

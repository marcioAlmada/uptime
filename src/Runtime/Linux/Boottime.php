<?php

namespace Uptime\Runtime\Linux;

use Uptime\Runtime\RuntimeInterface;

class Boottime implements RuntimeInterface
{
    public function read($source = '/proc/stat')
    {
        preg_match_all('#(?<=^btime).+#m', file_get_contents( $source ), $matches);

        return trim( $matches[0][0] );
    }
}

<?php

namespace Uptime\Runtime\Windows;

use Uptime\Runtime\RuntimeInterface;

class Boottime implements RuntimeInterface
{
    /**
     * Reads the wmic command which returns the last bootup time and converts it to a unix timestamp
     *
     * @param string $command wmic command
     * @return int
     */
    public function read($command = 'wmic os get lastbootuptime')
    {
        $wmicString = trim(explode("\n", shell_exec($command))[1]);

        $dateTime = \DateTime::createFromFormat(
            'YmdHis.uO',
            $this->convertWmicOffset($wmicString)
        );
        return $dateTime->getTimestamp();
    }

    /**
     * Takes the output of wmic os get lastbootuptime and converts the offset given in minutes to an HHMM offset acceptable by PHP createFromFormat 'O'
     *
     * @param string $wmicString string output given by wmic command
     * @return string
     */
    private function convertWmicOffset($wmicString)
    {
        $offset = substr($wmicString, -3);
        $hours = floor($offset / 60);
        $minutes = ($offset % 60);
        return substr($wmicString, 0, -3) . sprintf('%02d%02d', $hours, $minutes);
    }
}

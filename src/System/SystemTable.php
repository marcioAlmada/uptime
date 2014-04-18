<?php

namespace Uptime\System;

class SystemTable
{
    /**
     * Map relating possible values of `PHP_OS` and widely known OS groups
     * 
     * Values should be declared in lowercase.
     * 
     * @link http://stackoverflow.com/questions/738823/possible-values-for-php-os
     * @link http://en.wikipedia.org/wiki/Uname#Table_of_standard_uname_output
     * @link https://github.com/php/php-src/blob/5b1f6caaf0574cd72396b1b4c671bae82557c4b4/configure.in
     */
    protected static $map = [
        'Linux'   => [ 'linux', 'cygwin', 'linux-armv71', 'linux2', 'unix', 'sunos'], // `cat /proc/uptime`
        'Darwin'  => [ 'darwin', 'mac', 'osx'], //  `sysctl kern.boottime`
        'Windows' => [ 'win32', 'winnt', 'windows' ], // `wmic os get lastbootuptime`
    ];

    public static function getSystemIdentifier($system){
        $system = strtolower($system);
        foreach (self::getMap() as $identifier => $systems) {
            if( in_array($system, $systems) ) return $identifier;
        }
        return false;
    }

    public static function getMap()
    {
        return self::$map;
    }

}
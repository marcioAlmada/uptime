<?php

use Uptime\System;

if ( !function_exists('boottime') ){
    function boottime( $system = PHP_OS )
    {
        return (new System( $system ))->getBoottime()->getRaw();
    }
}

if ( !function_exists('uptime') ){
    function uptime( $system = PHP_OS )
    {
        return (new System( $system ))->getUptime()->getRaw();
    }
}

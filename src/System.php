<?php

namespace Uptime;

use Uptime\System\SystemInterface;
use Uptime\System\SystemTable;
use Uptime\System\UnsupportedSystemException;

/**
 * System
 *
 * Provides a cross-platform way to figure out the system uptime and boottime
 * Should work on most common operating systems supported by PHP
 *
 */
class System implements SystemInterface
{

    const ERROR = 'System "%s" is not supported yet. Patches welcome :)';

    const RUNTIME_CLASS = '\Uptime\Runtime\\%s\\%s';

    protected $system;

    public function __construct( $system = PHP_OS )
    {
        $this->system = SystemTable::getSystemIdentifier( $system );
        if( !$this->system ) {
            throw new UnsupportedSystemException( sprintf( self::ERROR, $system ) );
        }
    }

    public function getBoottime()
    {
        return $this->getTime('Boottime');
    }

    public function getUptime()
    {
        return $this->getTime('Uptime');
    }

    private function getTime($value_object)
    {
        $class = sprintf(self::RUNTIME_CLASS, $this->system,  $value_object);
        $runtime = new $class();
        $value_object = 'Uptime\\' . $value_object;
        return new $value_object( $runtime->read() );   
    }
}
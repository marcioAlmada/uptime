<?php

namespace Uptime\Runtime\OpenVMS;

/**
 * UptimeTest for OpenVMS
 *
 * @group runtime
 * @group openvms
 */
class UptimeTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider stdinProvider
     */
    public function testUptime($seconds, $stdout)
    {
        $uptime = new Uptime();
        $this->assertSame( $seconds, $uptime->read( "echo '{$stdout}'" ) );
    }

    public function stdinProvider()
    {
        $factory = function( $seconds, $uptime, $stdout ) {
            return [ $seconds, sprintf($stdout, $uptime) ];
        };
        return [
            $factory(135, '0 00:02:15',   'OpenVMS V8.5-2 on node CLASS2   8-FEB-2007 08:39:23.23  Uptime  %s'),
            $factory(343243, '3 23:20:43',   'OpenVMS V7.2-2  on node CHEER  27-JAN-2003 16:09:26.94  Uptime  %s'),
            $factory(2160135, '25 00:02:15',  'OpenVMS V8.52 on node  CLASS2   8-FEB-2007 08:39:23.23  Uptime  %s'),
            $factory(10368135, '120 00:02:15', 'OpenVMS V8.52 on node  CLASS2   8-FEB-2007 08:39:23.23  Uptime  %s'),
            $factory(77322532, '894 22:28:52', 'OpenVMS V7.3-2 on node JACK 29-JAN-2008    16:32:04.67  Uptime  %s'),
        ];
    }
}






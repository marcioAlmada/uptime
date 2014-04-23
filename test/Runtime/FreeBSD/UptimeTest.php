<?php

namespace Uptime\Runtime\FreeBSD;

/**
 * UptimeTest for FreeBSD
 *
 * @group runtime
 * @group freebsd
 */
class UptimeTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider stdinProvider
     */
    public function testUptime($time, $stdout)
    {
        $uptime = new Uptime();
        $this->assertEquals( $time, $uptime->read( "echo '{$stdout}'" ) );
    }

    public function stdinProvider()
    {
        $factory = function( $number, $struct ) {
            return [ $number, sprintf($struct, $number, $number) ];
        };
        return [
            $factory( rand(0, 100), 'kern.boottime: { sec =%s, usec = %s }'         ),
            $factory( rand(100, 10000), 'kern.boottime: { sec= %s, usec = %s }'     ),
            $factory( rand(10000, 1000000), 'kern.boottime: {sec = %s, usec = %s }' ),
            $factory( rand(1000000, 10000000), '{ sec = %s, usec = %s }'            ),
            $factory( rand(10000000, PHP_INT_MAX), '{ sec = %s , usec = %s }'       ),
        ];
    }
}

<?php

namespace Uptime\Runtime\Windows;

use Mockery as m;

/**
 * UptimeTest for Windows
 *
 * @group runtime
 * @group windows
 */
class UptimeTest extends \PHPUnit_Framework_TestCase
{

    protected function tearDown()
    {
        m::close();
    }

    public function testUptime()
    {
        $uptime = new Uptime();
        $runtime = m::mock('\Uptime\Runtime\RuntimeInterface');
        $runtime->shouldReceive('read')->times(4)->andReturn(
            '20140429225056.153618-180',
            '20140429225056.153618-180',
            '20130921162204.221342+120',
            '20130921162204.221343+120'
        );
        $this->assertEquals($uptime->read($runtime), $uptime->read($runtime));
        $this->assertNotEquals($uptime->read($runtime), $uptime->read($runtime));
    }
}

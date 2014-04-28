<?php

namespace Uptime\Runtime\OpenVMS;

use Mockery as m;

/**
 * BoottimeTest for OpenVMS
 *
 * @group runtime
 * @group openvms
 */
class BoottimeTest extends \PHPUnit_Framework_TestCase
{

    protected function tearDown() {
        m::close();
    }

    public function testBoottime()
    {
        $boottime = new Boottime();
        $runtime = m::mock('\Uptime\Runtime\RuntimeInterface'); 
        $runtime->shouldReceive('read')->times(4)->andReturn(0);
        $this->assertInternalType('integer', $boottime->read($runtime));
        $this->assertGreaterThan(0, $boottime->read($runtime));
        $this->assertEquals($boottime->read($runtime), $boottime->read($runtime));
    }
}
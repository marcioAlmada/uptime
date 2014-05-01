<?php

namespace Uptime\Runtime\Linux;

/**
 * BoottimeTest for Linux
 *
 * @group runtime
 * @group linux
 */
class BoottimeTest extends \PHPUnit_Framework_TestCase
{

    public function testBoottime()
    {
        $fixture = __DIR__ . '/Fixtures/proc-stat-fedora20.fixture';
        $uptime = new Boottime();
        $this->assertEquals(1398698286, $uptime->read($fixture));
    }
}

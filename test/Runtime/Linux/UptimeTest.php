<?php

namespace Uptime\Runtime\Linux;

/**
 * UptimeTest for Linux
 *
 * @group runtime
 * @group linux
 */
class UptimeTest extends \PHPUnit_Framework_TestCase
{

    public function testUptime()
    {
        $uptime = new Uptime();
        $this->assertEquals(34.895,    $uptime->read('data://,34.895    447925.64'));
        $this->assertEquals(29784.67,  $uptime->read('data://,29784.67  447925.64'));
        $this->assertEquals(121946.78, $uptime->read('data://,121946.78 447925.64'));
    }
}

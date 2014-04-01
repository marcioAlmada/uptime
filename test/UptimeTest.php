<?php

namespace Uptime;

/**
 * UptimeTest
 * 
 * @group time
 */
class UptimeTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider uptimeProvider
     */
    public function testUptime($raw_uptime, $d, $h, $m, $s)
    {
        $uptime = new Uptime($raw_uptime);
        $this->assertEquals($raw_uptime, $uptime->getRaw());
        $this->assertEquals($d, $uptime->d);
        $this->assertEquals($h, $uptime->h);
        $this->assertEquals($m, $uptime->i);
        $this->assertEquals($s, $uptime->s);
    }

    public function uptimeProvider()
    {
        return [ // [raw_time, d, h,  m,  s]
            [59052.82, 0, 16, 24, 12],
            [114775.20, 1, 7, 52, 55],
            [987625.68, 11, 10, 20, 25]
        ];
    }

    public function testToString()
    {
        $raw_time = 125314.93;
        $uptime = new Uptime($raw_time);
        $this->assertEquals((string) $raw_time, $uptime);
        $this->assertSame((string) $raw_time, $uptime . '');
    }
}

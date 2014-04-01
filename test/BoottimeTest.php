<?php

namespace Uptime;

use DateTime;

/**
 * @group time
 */
class BoottimeTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider boottimeProvider
     */
    public function testBoottime($timestamp)
    {
        $this->assertSame($timestamp, (new Boottime($timestamp))->getRaw());
    }

    public function boottimeProvider()
    {
        return [
            [1398342505],
        ];
    }

    public function testToString()
    {
        $timestamp = 1398342505;
        $date = (new DateTime('@'.$timestamp))->format('Y-m-d H:i:s');
        $boottime = new Boottime($timestamp);
        $this->assertEquals($date, $boottime);
        $this->assertSame($date, $boottime . '');
    }
}

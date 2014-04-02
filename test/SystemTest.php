<?php

namespace Uptime;

use Uptime\System\SystemTable;

/**
 * @group system
 */
class SystemTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider             commandProvider
     * @expectedException        Uptime\System\UnsupportedSystemException
     * @expectedExceptionMessage Unknown" is not supported
     */
    public function testUnsupportedSystemException( $method )
    {
        (new System('Unknown'))->{ $method }();
    }

    public function commandProvider()
    {
        return [
            ['getBoottime'],
            [ 'getUptime' ]
        ];
    }

}
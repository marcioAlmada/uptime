<?php

namespace Uptime\Runtime\Windows;

/**
 * BoottimeTest for Windows
 *
 * @group runtime
 * @group windows
 */
class BoottimeTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider stdinProvider
     */
    public function testBoottime($timestamp, $stdout)
    {
        $boottime = new Boottime();
        $this->assertSame($timestamp, $boottime->read("echo '{$stdout}'"));
    }

    public function stdinProvider()
    {
        $factory = function ($timestamp, $inputString, $stdout) {
            return [ $timestamp, sprintf($stdout, $inputString) ];
        };

        return [
            $factory(1398820256, '20140429225056.153625-180', "LastBootUpTime\n%s\n\n\n"),
            $factory(1339509056, '20120612125056.153625-060', "LastBootUpTime\n%s\n\n\n"),
            $factory(1379775724, '20130921162204.153625+120', "LastBootUpTime\n%s\n\n\n"),
        ];
    }
}

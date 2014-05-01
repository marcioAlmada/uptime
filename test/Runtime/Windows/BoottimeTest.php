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
        $factory = function ($timestamp, $stdout) {
            return [ $timestamp, sprintf($stdout, $timestamp) ];
        };

        return [
            $factory('20140429225056.153625-180', "LastBootUpTime\n%s\n\n\n"),
            $factory('20120612125056.153625-060', "LastBootUpTime\n%s\n\n\n"),
            $factory('20130921162204.153625+120', "LastBootUpTime\n%s\n\n\n"),
        ];
    }
}

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
            $factory(1398822656, '20140429225056.153625-180', "LastBootUpTime\n%s\n\n\n"),
            $factory(1339509056, '20120612125056.153625-060', "LastBootUpTime\n%s\n\n\n"),
            $factory(1379773324, '20130921162204.153625+120', "LastBootUpTime\n%s\n\n\n"),
        ];
    }

    /**
     * Test for different timezones
     *
     * Last 3 digits of wmic returns a timezone offset in minutes (+ or -)
     *
     * @return void
     */
    public function testTimeZones()
    {
        $timeString = '20160607160855.488750';
        $utTime = new \DateTime('2016-06-07 16:08:55', new \DateTimeZone('utc'));
        $boottime = new Boottime();

        // Positive timezone offsets
        for ($i = 0; $i <= 12; ++$i) {
            $expectedTime = clone $utTime;
            $expectedTime->modify("-$i hour");
            $offset = sprintf('%03d', $i * 60);

            $this->assertSame(
                $boottime->read("echo ; echo '{$timeString}+{$offset}'"),
                $expectedTime->getTimestamp()
            );
        }

        // Negative timezone offsets
        for ($i = 0; $i <= 12; ++$i) {
            $expectedTime = clone $utTime;
            $expectedTime->modify("+$i hour");
            $offset = sprintf('%03d', $i * 60);

            $this->assertSame(
                $boottime->read("echo ; echo '{$timeString}-{$offset}'"),
                $expectedTime->getTimestamp()
            );
        }
    }
}

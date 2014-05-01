<?php

namespace Uptime\System;

/**
 * SystemTableTest
 *
 * @group system
 */
class SystemTableTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider needleGroupProvider
     */
    public function testSystemTable($needle, $group)
    {
        $this->assertSame($group, (new SystemTable())->getSystemIdentifier($needle));
    }

    public function needleGroupProvider()
    {
        $randomcase = function (&$string) {
            $chars = str_split($string);
            array_walk($chars, function (&$char) {
                rand(0, 1) ? $char = strtoupper($char) : $char = strtolower($char);
            });

            return implode('', $chars);
        };
        $data = [];
        foreach ( SystemTable::getMap() as $group => $systems ) {
            $data[] = [$group, $group];
            foreach ($systems as $system) {
                $data[] = [ucfirst($system), $group];
                $data[] = [$randomcase($system), $group];
            }
        }

        return $data;
    }
}

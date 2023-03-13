<?php


namespace HyperfTest\Cases;


use PHPUnit\Framework\TestCase;

class FunctionsTest extends TestCase
{
    public function testMaxCommonDivisor()
    {
        $this->assertEquals(6, maxCommonDivisor(12, 42));
        $this->assertEquals(6, maxCommonDivisor(42, 12));
        $this->assertEquals(null, maxCommonDivisor(-42, 12));
        $this->assertEquals(1, maxCommonDivisor(43, 12));
    }

    public function testMora()
    {
        $this->assertEquals(0, mora(0, 0));// 剪刀、剪刀
        $this->assertEquals(-1, mora(0, 1));// 剪刀、石头
        $this->assertEquals(1, mora(0, 2));// 剪刀、布
        $this->assertEquals(-1, mora(1, 2));// 石头、布
        $this->assertEquals(1, mora(1, 0));// 石头、剪刀
    }
}

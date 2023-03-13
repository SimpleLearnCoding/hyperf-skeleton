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
}
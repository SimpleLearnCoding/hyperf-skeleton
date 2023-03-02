<?php


namespace Cases;


use Cases\Database\Database;

/**
 * Class MockDatabaseTest
 *
 * @author  linnzh
 * @created 2023/3/1 16:49
 */
class MockDatabaseTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @link https://docs.phpunit.de/en/9.6/test-doubles.html#mock-objects
     * @author  linnzh
     * @created 2023/3/1 17:20
     */
    public function testGetData()
    {
        // Create a mock database object.
        $mockDb = $this->getMockBuilder(Database::class)
            ->setMethods(['getData'])
            ->getMock();

        // Set up the expectation for the getData() method to be called once and return an array of data.
        $mockDb->expects($this->once())->method('getData')->willReturn([1, 2, 3]);

        // Call the getData() method on the mock object and assert that it returns an array of data.

        $this->assertEquals([1, 2, 3], $mockDb->getData());
    }
}
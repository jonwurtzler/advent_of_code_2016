<?php
use Advent\ValidDesigns;

/**
 * ValidDesignsTest -
 *
 */
class ValidDesignsTest extends PHPUnit_Framework_TestCase
{
    // TC comes from the website examples. (TC = Test Case)
    public function testVerifyDesignsTC1()
    {
        $validDesigns = new ValidDesigns();
        $this->assertEquals(0, $validDesigns->verifyDesigns([[5, 10, 25], [5, 5, 10]]));
    }

    public function testSmallS1S2()
    {
        $validDesigns = new ValidDesigns();
        $this->assertEquals(0, $validDesigns->verifyDesigns([[5, 10, 25]]));
    }

    public function testSmallS2S3()
    {
        $validDesigns = new ValidDesigns();
        $this->assertEquals(0, $validDesigns->verifyDesigns([[25, 10, 5]]));
    }

    public function testSmallS1S3()
    {
        $validDesigns = new ValidDesigns();
        $this->assertEquals(0, $validDesigns->verifyDesigns([[5, 25, 10]]));
    }

    public function testStep2Exception()
    {
        $validDesigns = new ValidDesigns();
        $this->expectException(Exception::class);
        $validDesigns->verifyDesigns([[16, 25, 10]], true);
    }

    public function testStep2()
    {
        $validDesigns = new ValidDesigns();
        $this->assertEquals(3, $validDesigns->verifyDesigns([[16, 25, 10], [25, 10, 16], [10, 16, 25]], true));
    }

}

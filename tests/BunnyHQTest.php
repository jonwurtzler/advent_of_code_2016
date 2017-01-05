<?php

use Advent\BunnyHQ;

/**
 * BunnyHQTest -
 *
 */
class BunnyHQTest extends PHPUnit_Framework_TestCase
{
    // TC comes from the website examples. (TC = Test Case)
    public function testFollowDirectionsTC1()
    {
        $bunnyHQ = new BunnyHQ();
        $this->assertEquals(5, $bunnyHQ->followDirections(['R2', 'L3']));
    }

    // TC comes from the website examples. (TC = Test Case)
    public function testFollowDirectionsTC2()
    {
        $bunnyHQ = new BunnyHQ();
        $this->assertEquals(2, $bunnyHQ->followDirections(['R2', 'R2', 'R2']));
    }

    // TC comes from the website examples. (TC = Test Case)
    public function testFollowDirectionsTC3()
    {
        $bunnyHQ = new BunnyHQ();
        $this->assertEquals(12, $bunnyHQ->followDirections(['R5', 'L5', 'R5', 'R3']));
    }
}

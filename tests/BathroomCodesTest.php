<?php
use Advent\BathroomCodes;

/**
 * BathroomCodesTest -
 *
 */
class BathroomCodesTest extends PHPUnit_Framework_TestCase
{
    // TC comes from the website examples. (TC = Test Case)
    public function testFindCodeTC1()
    {
        $bathroomCodes = new BathroomCodes();
        $this->assertEquals(1985, $bathroomCodes->findCode(['ULL', 'RRDDD', 'LURDL', 'UUUUD']));
    }

}

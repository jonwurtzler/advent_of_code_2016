<?php
use Advent\SecurityCode;

/**
 * SecurityCodeTest -
 *
 */
class SecurityCodeTest extends PHPUnit_Framework_TestCase
{
    // TC comes from the website examples. (TC = Test Case)
    public function testSecurityCodeTC1()
    {
        $securityCode = new SecurityCode();
        $this->assertEquals('18f47a30', $securityCode->hashDoorPassword('abc'));
    }

    public function testSecurityCodeTC2()
    {
        $securityCode = new SecurityCode();
        $this->assertEquals('05ace8e3', $securityCode->hashDoorPassword('abc', true));
    }
}

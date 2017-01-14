<?php
use Advent\NetworkIPs;

/**
 * NetworkIPsTest -
 *
 */
class NetworkIPsTest extends PHPUnit_Framework_TestCase
{
    // TC comes from the website examples. (TC = Test Case)
    public function testNetworkIPsTC1()
    {
        $networkIPs = new NetworkIPs();
        $this->assertTrue($networkIPs->isTLSIP('abba[mnop]qrst'));
    }

    public function testNetworkIPsTC2()
    {
        $networkIPs = new NetworkIPs();
        $this->assertFalse($networkIPs->isTLSIP('abcd[bddb]xyyx'));
    }

    public function testNetworkIPsTC3()
    {
        $networkIPs = new NetworkIPs();
        $this->assertFalse($networkIPs->isTLSIP('aaaa[qwer]tyui'));
    }

    public function testNetworkIPsTC4()
    {
        $networkIPs = new NetworkIPs();
        $this->assertTrue($networkIPs->isTLSIP('ioxxoj[asdfgh]zxcvbn'));
    }
}

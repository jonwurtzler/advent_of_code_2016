<?php

namespace Advent;

use DataLoader;

class NetworkIPs implements AdventOutputInterface
{
    /**
     * @var string
     */
    private $dataFile = 'networkIPs.txt';

    /**
     * @var int
     */
    private $verifiedCount = 0;

    /**
     * Display the Advent Day's work.
     *
     * @return void
     */
    public function display()
    {
        // Load datafile
        $networkIPs = DataLoader::loadFileAsArrayData($this->dataFile);

        // Step 1
        $verifiedCount1 = $this->verifyTLSIPs($networkIPs);
        echo (sprintf('IPs that have TLS is: %s', $verifiedCount1) . "\n");
    }

    /**
     * Run through all IPs and verify TLS for each.
     *
     * @param string[] $networkIPs
     *
     * @return int
     */
    public function verifyTLSIPs($networkIPs)
    {
        foreach ($networkIPs as $ip) {
            if ($this->isTLSIP($ip)) {
                $this->verifiedCount++;
                continue;
            }
        }

        return $this->verifiedCount;
    }

    /**
     * Break up the ip and determin if TLS applies.
     *
     * @param string $ip
     *
     * @return bool
     */
    public function isTLSIP($ip)
    {
        $ipParts     = explode('[', $ip);
        $front       = array_shift($ipParts);
        $ipParts     = explode(']', array_shift($ipParts));
        $hypernetSeq = array_shift($ipParts);
        $end         = array_shift($ipParts);

        if (
            $this->hasABBA($hypernetSeq)
            || (!$this->hasABBA($front) && !$this->hasABBA($end))
        ) {
            return false;
        }

        return true;
    }

    /**
     * Determine if the string has the ABBA pattern
     *
     * @param string $part
     *
     * @return bool
     */
    private function hasABBA($part)
    {
        if (preg_match('^(?!.*(.)(.)\2\1)', $part)) {
            return true;
        }

        return false;
    }

    /*
    private function hasABBA($part)
    {
        $char1 = '';
        $char2 = '';
        $char3 = '';

        foreach ($part as $char) {
            if (empty($char1)) {
                $char1 = $char;
                continue;
            }

            // Second char should be different from the first
            if (!empty($char1) && empty($char2) && $char1 != $char) {
                $char2 = $char;
                continue;
            }

            // Third char should be the same as the second
            if (!empty($char1) && !empty($char2) && empty($char3) && $char2 == $char) {
                $char3 = $char;
                continue;
            }

            if (!empty($char1) && !empty($char2) && !empty($char3) && $char == $char1) {
                return true;
            }

            $char1 = '';
            $char2 = '';
            $char3 = '';
        }

        return false;
    }
    */

}

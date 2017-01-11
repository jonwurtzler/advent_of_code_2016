<?php

namespace Advent;

// Step 1: c6697b55 is the correct code.
// Step 2: 8c35d1ab is the correct code.
class SecurityCode implements AdventOutputInterface
{
    /**
     * @var bool
     */
    private $debug = false;

    /**
     * Display the Advent Day's work.
     *
     * @return void
     */
    public function display()
    {
        $securityDoorId = 'ffykfhsq';

        // Step 1
        $doorCode1 = $this->hashDoorPassword($securityDoorId);
        echo (sprintf('Security Door Password is %s', $doorCode1) . "\n\n");

        // Step 2
        $doorCode2 = $this->hashDoorPassword($securityDoorId, true);
        echo (sprintf('Advanced Security Door Password is %s', $doorCode2) . "\n\n");
    }

    /**
     * Hammer the door code by hashing the id with an number.
     *
     * @param string $id
     *
     * @return string
     */
    public function hashDoorPassword($id, $step2 = false)
    {
        $i        = 0;
        $password = [];

        while (count($password) < 8) {
            $hash = md5($id . $i);

            if (0 === strpos($hash, '00000')) {
                if ($this->debug) {
                    echo "Hash Found: " . $hash . " int: " . $i . "\n";
                } else {
                    echo ".";
                }

                // Simple code set and return.
                if (!$step2) {
                    $password[] = $hash[5];
                    $i++;
                    continue;
                }

                // Use advanced method
                $pos = $hash[5];
                if (is_numeric($pos) && $pos < 8 && !isset($password[$pos])) {
                    $password[$pos] = $hash[6];
                }
            }

            $i++;
        }

        ksort($password);

        return implode($password);
    }
}

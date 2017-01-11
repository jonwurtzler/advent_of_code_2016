<?php

namespace Advent;

// Step 1: c6697b55 is the correct code.
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
    }

    /**
     * Hammer the door code by hashing the id with an number.
     *
     * @param string $id
     *
     * @return string
     */
    public function hashDoorPassword($id)
    {
        $i        = 0;
        $password = '';

        while (strlen($password) < 8) {
            $hash = md5($id . $i);

            if (0 === strpos($hash, '00000')) {
                if ($this->debug) { echo "Hash Found: " . $hash . "\n"; }
                $password .= $hash[5];
            }

            $i++;
        }

        return $password;
    }
}

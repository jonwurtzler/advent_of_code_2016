<?php

namespace Advent;

use DataLoader;

// Step 1: 38961 is the right answer
class BathroomCodes implements AdventOutputInterface
{
    /**
     * @var string
     */
    private $dataFile = 'bathroomCodes.txt';

    /**
     * Display the Advent Day's work.
     *
     * @return void
     */
    public function display()
    {
        // Load datafile
        $codePaths = DataLoader::loadFileAsArrayData($this->dataFile);

        // Step 1
        $code1 = $this->findCode($codePaths);
        echo (sprintf('Bathroom Code 1 is: %d', $code1) . "\n");
    }

    /**
     * Run through each of the code paths to determine the code.
     *
     * @param string[] $codePaths
     *
     * @return string
     */
    public function findCode($codePaths)
    {
        $code = [];
        $key  = 5;

        foreach ($codePaths as $path) {
            for ($i = 0; $i < strlen($path); $i++) {
                $this->moveFinger($key, $path[$i]);
            }

            $code[] = $key;
        }

        return implode($code);
    }

    /**
     * Move your finger on the keypad based on direction.
     *
     * @param int    &$currentKey
     * @param string $direction
     *
     * @return void
     */
    private function moveFinger(&$currentKey, $direction)
    {
        $directions = ['U', 'R', 'D', 'L'];

        if (!in_array($direction, $directions)) {
            return;
        }

        switch ($direction) {
            case 'U':
                if (in_array($currentKey, [1, 2, 3])) {
                    break;
                }

                $currentKey -= 3;
                break;
            case 'R':
                if (in_array($currentKey, [3, 6, 9])) {
                    break;
                }

                $currentKey++;
                break;
            case 'D':
                if (in_array($currentKey, [7, 8, 9])) {
                    break;
                }

                $currentKey += 3;
                break;
            case 'L':
                if (in_array($currentKey, [1, 4, 7])) {
                    break;
                }

                $currentKey--;
                break;
        }
    }
}

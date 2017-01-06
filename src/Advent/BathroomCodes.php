<?php

namespace Advent;

use DataLoader;

// Step 1: 38961 is the right answer

// Step 2: 46C92 is the right answer
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

        // Step 2
        $code2 = $this->findCode($codePaths, true);
        echo (sprintf('Bathroom Code 2 (Advanced) is: %s', $code2) . "\n");
    }

    /**
     * Run through each of the code paths to determine the code.
     *
     * @param string[] $codePaths
     *
     * @return string
     */
    public function findCode($codePaths, $step2 = false)
    {
        $directions = ['U', 'R', 'D', 'L'];
        $code       = [];
        $key        = 5;

        if ($step2) { $key = '5'; }

        foreach ($codePaths as $path) {
            for ($i = 0; $i < strlen($path); $i++) {
                if (in_array($path[$i], $directions)) {
                    if (!$step2) {
                        $this->moveFinger($key, $path[$i]);
                    } else {
                        $this->moveFingerAdvanced($key, $path[$i]);
                    }
                }
            }

            $code[] = $key;
        }

        return implode($code);
    }

    /**
     * Move your finger on the keypad based on direction.
     *
     * Uses the basic keypad:
     *
     *  1   2   3
     *  4   5   6
     *  7   8   9
     *
     * @param int    &$currentKey
     * @param string $direction
     *
     * @return void
     */
    private function moveFinger(&$currentKey, $direction)
    {
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

    /**
     * Move your finger on the keypad based on direction.
     *
     * Uses the advanced keypad:
     *
     *          1
     *      2   3   4
     *  5   6   7   8   9
     *      A   B   C
     *          D
     *
     * @param string &$currentKey
     * @param string $direction
     *
     * @return void
     */
    private function moveFingerAdvanced(&$currentKey, $direction)
    {
        $row2 = ['2', '3', '4'];
        $row3 = ['5', '6', '7', '8', '9'];
        $row4 = ['A', 'B', 'C'];

        $col2 = ['2', '6', 'A'];
        $col3 = ['1', '3', '7', 'B', 'D'];
        $col4 = ['4', '8', 'C'];

        switch ($direction) {
            case 'U':
                if (in_array($currentKey, ['5', '2', '1', '4', '9'])) {
                    break;
                }

                $i = array_search($currentKey, $col2);
                if ($i > -1) {
                    $currentKey = $col2[--$i];
                    break;
                }

                $i = array_search($currentKey, $col3);
                if ($i > -1) {
                    $currentKey = $col3[--$i];
                    break;
                }

                $i = array_search($currentKey, $col4);
                if ($i > -1) {
                    $currentKey = $col4[--$i];
                    break;
                }

                break;

            case 'R':
                if (in_array($currentKey, ['1', '4', '9', 'C', 'D'])) {
                    break;
                }

                $i = array_search($currentKey, $row2);
                if ($i > -1) {
                    $currentKey = $row2[++$i];
                    break;
                }

                $i = array_search($currentKey, $row3);
                if ($i > -1) {
                    $currentKey = $row3[++$i];
                    break;
                }

                $i = array_search($currentKey, $row4);
                if ($i > -1) {
                    $currentKey = $row4[++$i];
                    break;
                }

                break;

            case 'D':
                if (in_array($currentKey, ['5', 'A', 'D', 'C', '9'])) {
                    break;
                }

                $i = array_search($currentKey, $col2);
                if ($i > -1) {
                    $currentKey = $col2[++$i];
                    break;
                }

                $i = array_search($currentKey, $col3);
                if ($i > -1) {
                    $currentKey = $col3[++$i];
                    break;
                }

                $i = array_search($currentKey, $col4);
                if ($i > -1) {
                    $currentKey = $col4[++$i];
                    break;
                }

                break;

            case 'L':
                if (in_array($currentKey, ['1', '2', '5', 'A', 'D'])) {
                    break;
                }

                $i = array_search($currentKey, $row2);
                if ($i > -1) {
                    $currentKey = $row2[--$i];
                    break;
                }

                $i = array_search($currentKey, $row3);
                if ($i > -1) {
                    $currentKey = $row3[--$i];
                    break;
                }

                $i = array_search($currentKey, $row4);
                if ($i > -1) {
                    $currentKey = $row4[--$i];
                    break;
                }

                break;
        }
    }
}

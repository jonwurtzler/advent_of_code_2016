<?php

namespace Advent;

use DataLoader;

// Step 1: zcreqgiv is the right code
// Step 2: pljvorrk is the right code
class RepetitionCodes implements AdventOutputInterface
{
    /**
     * @var string
     */
    private $dataFile = 'repetitionCodes.txt';

    /**
     * Display the Advent Day's work.
     *
     * @return void
     */
    public function display()
    {
        // Load datafile
        $repetitionCodes = DataLoader::loadFileAsArrayData($this->dataFile);

        // Step 1
        $code1 = $this->findCode($repetitionCodes);
        echo (sprintf('Repetition Code 1 is: %s', $code1) . "\n");

        // Step 2
        $code2 = $this->findCode($repetitionCodes, true);
        echo (sprintf('Repetition Code 2 (Advanced) is: %s', $code2) . "\n");
    }

    /**
     * Cycle through each row and get the most used character of each column.
     *
     * @param string[] $repetitionCodes
     * @param bool     $step2
     *
     * @return string
     */
    public function findCode($repetitionCodes, $step2 = false)
    {
        $codeInfo  = [];
        $finalCode = '';

        // Get a count of all characters in each column.
        foreach ($repetitionCodes as $code) {
            for ($i = 0; $i < strlen($code); $i++) {
                $char = $code[$i];

                if (isset($codeInfo[$i][$char])) {
                    $codeInfo[$i][$char] += 1;
                    continue;
                }

                $codeInfo[$i][$char] = 1;
            }
        }

        foreach ($codeInfo as $colInfo) {
            if ($step2) {
                asort($colInfo);
            } else {
                arsort($colInfo);
            }

            $finalCode .= key($colInfo);
        }

        return $finalCode;
    }

}

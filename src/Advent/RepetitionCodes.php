<?php

namespace Advent;

use DataLoader;

// Step 1: zcreqgiv is the right code
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
    }

    /**
     * Cycle through each row and get the most used character of each column.
     *
     * @param string[] $repetitionCodes
     *
     * @return string
     */
    public function findCode($repetitionCodes)
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
            arsort($colInfo);
            $finalCode .= key($colInfo);
        }

        return $finalCode;
    }

}

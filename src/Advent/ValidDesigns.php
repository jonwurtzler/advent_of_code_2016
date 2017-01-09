<?php

namespace Advent;

use DataLoader;

// Step 1: 995 is too high
// Step 1: 993 is correct.  (Needed to be greater than, not greater than or equal to).
class ValidDesigns implements AdventOutputInterface
{
    /**
     * @var string
     */
    private $dataFile = 'validDesigns.txt';

    /**
     * @var int
     */
    private $validCount = 0;

    /**
     * Display the Advent Day's work.
     *
     * @return void
     */
    public function display()
    {
        // Load datafile
        $designs = DataLoader::loadFileAsArrayData($this->dataFile);

        // Step 1
        $validCount = $this->verifyDesigns($designs);
        echo (sprintf('Designs: %d out of %d are valid', $validCount, count($designs)) . "\n");
    }

    /**
     * Go through all the submitted designs and find out how many are valid.
     *
     * @param string[] $designs
     *
     * @return int
     */
    public function verifyDesigns($designs)
    {
        foreach ($designs as $design) {
            $design = array_map('intval', preg_split('/\s+/', trim($design)));

            if ($this->isValidTriangle($design[0], $design[1], $design[2])) {
                $this->validCount++;
            }
        }

        return $this->validCount;
    }

    /**
     * Verify that a given triangle is valid based on side lengths.
     *
     * @param int $s1
     * @param int $s2
     * @param int $s3
     *
     * @return bool
     */
    private function isValidTriangle($s1, $s2, $s3)
    {
        if (($s1 + $s2) <= $s3 ) {
            return false;
        }

        if (($s2 + $s3) <= $s1 ) {
            return false;
        }

        if (($s1 + $s3) <= $s2 ) {
            return false;
        }

        return true;
    }
}

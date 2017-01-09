<?php

namespace Advent;

use DataLoader;
use Exception;

// Step 1: 995 is too high
// Step 1: 993 is correct.  (Needed to be greater than, not greater than or equal to).

// Step 2: 1849 is correct.
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

        // Convert to int array values
        foreach ($designs as $i => $design) {
            $designs[$i] = array_map('intval', preg_split('/\s+/', trim($design)));
        }

        // Step 1
        $validCount = $this->verifyDesigns($designs);
        echo (sprintf('Designs: %d out of %d are valid.', $validCount, count($designs)) . "\n");

        // Reset count between steps.
        $this->validCount = 0;

        // Step 2
        $validCount2 = $this->verifyDesigns($designs, true);
        echo (sprintf('Designs: %d out of %d are valid. (Column Sorted)', $validCount2, count($designs)) . "\n");
    }

    /**
     * Go through all the submitted designs and find out how many are valid.
     *
     * @param string[] $designs
     *
     * @return int
     */
    public function verifyDesigns($designs, $step2 = false)
    {
        if ($step2) {
            $designs = $this->verifyByCol($designs);
        }

        foreach ($designs as $design) {
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

    /**
     * Get groups of
     *
     * @param $designs
     *
     * @return array
     * @throws Exception
     */
    private function verifyByCol($designs)
    {
        if (0 != (count($designs) %3)) {
            throw new Exception("Please enter a number of rows evenly divided by 3");
        }

        $designsByCol = [];

        for ($i = 0; $i < count($designs); $i += 3) {
            $row1 = $designs[$i];
            $row2 = $designs[$i + 1];
            $row3 = $designs[$i + 2];

            $designsByCol[] = [$row1[0], $row2[0], $row3[0]];
            $designsByCol[] = [$row1[1], $row2[1], $row3[1]];
            $designsByCol[] = [$row1[2], $row2[2], $row3[2]];
        }

        return $designsByCol;
    }
}

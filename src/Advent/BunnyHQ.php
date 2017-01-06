<?php

namespace Advent;

use DataLoader;

// Step 1: 292 is too high
// Step 1: 288 is the right answer

// Step 2: 275 is too high
// Step 2: 22 is not right.
// Step 2: 273 is not right.
// Step 2: 9 is not right.
// Step 2: 111 is the correct answer
class BunnyHQ implements AdventOutputInterface
{
    /**
     * @var string
     */
    private $dataFile = 'bunnyHQ.txt';

    /**
     * Display the Advent Day's work.
     *
     * @return void
     */
    public function display()
    {
        $directions = DataLoader::loadFileAsArrayData($this->dataFile);

        $blocksAway1 = $this->followDirections($directions);
        $blocksAway2 = $this->followDirections($directions, true);

        echo (sprintf('Santa is %d block(s) away from Easter Bunny HQ', $blocksAway1) . "\n");
        echo (sprintf('Santa is %d block(s) away from Easter Bunny HQ (First Repeated Coordinates)', $blocksAway2) . "\n");
    }

    /**
     * @param array $directions
     *
     * @return number
     */
    public function followDirections($directions, $step2 = false)
    {
        $cords   = [0, 0];
        $facing  = 'n';
        $visited = ["0,0"];

        foreach ($directions as $direction) {
            // Split direction into needed parts.
            $turn     = $direction[0];
            $distance = (int) substr($direction, 1);
            $previous = $cords;

            // Follow the turn/distance given
            $this->follow($cords, $facing, $turn, $distance);

            // Step 2, stop on first point visited twice
            if ($step2) {
                $points = $this->getAllPoints($previous, $cords);

                foreach ($points as $point) {
                    $sPoint = implode(',', $point);

                    // If we are visiting this again, we stop on current cords
                    if (in_array($sPoint, $visited)) {
                        return $this->calculateDistanceAway($point);
                    }

                    $visited[] = $sPoint;
                }
            }
        }

        // Calculate how many blocks away we are
        return $this->calculateDistanceAway($cords);
    }

    /**
     * Determine how far away we are
     *
     * @param $cords
     *
     * @return number
     */
    private function calculateDistanceAway($cords)
    {
        return abs($cords[0]) + abs($cords[1]);
    }

    /**
     * Update the cords based on the passed information
     *
     * @param int[]  $cords
     * @param string $facing
     * @param string $turn
     * @param int    $distance
     *
     * @return void
     */
    private function follow(&$cords, &$facing, $turn, $distance)
    {
        if ('n' === $facing) {
            if ('L' === $turn) {
                $cords[1] -= $distance;
                $facing    = 'w';
            } else {
                $cords[1] += $distance;
                $facing    = 'e';
            }
        } elseif ('s' === $facing) {
            if ('L' === $turn) {
                $cords[1] += $distance;
                $facing    = 'e';

            } else {
                $cords[1] -= $distance;
                $facing    = 'w';
            }
        } elseif ('e' === $facing) {
            if ('L' === $turn) {
                $cords[0] += $distance;
                $facing    = 'n';
            } else {
                $cords[0] -= $distance;
                $facing    = 's';
            }
        } elseif ('w' === $facing) {
            if ('L' === $turn) {
                $cords[0] -= $distance;
                $facing    = 's';
            } else {
                $cords[0] += $distance;
                $facing    = 'n';
            }
        }
    }

    /**
     * Generate all points between each final destination
     *
     * @param int[] $startingCords
     * @param int[] $endingCords
     *
     * @return array
     */
    private function getAllPoints($startingCords, $endingCords)
    {
        $points = [];

        // Default state is assuming starting y is less than ending y
        $d = 0;
        $m = 1;

        // If starting y is greater than ending y
        if ($startingCords[0] > $endingCords[0]) {
            $m = -1;
        }

        // If starting x is less than ending x
        if ($startingCords[1] < $endingCords[1]) {
            $d = 1;

        // If starting x is greater than ending x
        } elseif ($startingCords[1] > $endingCords[1]) {
            $d = 1;
            $m = -1;
        }

        $diff = abs($startingCords[$d] - $endingCords[$d]);

        // Process all points between
        for ($i = 0; $i < $diff; $i++) {
            $startingCords[$d] += ($m * 1);
            $points[] = $startingCords;
        }

        return $points;
    }
}

<?php

namespace Advent;

use DataLoader;

// Step1: 292 is too high
// Step2: 288 is the right answer
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

        $blocksAway = $this->followDirections($directions);

        echo (sprintf('Santa is %d block(s) away from Easter Bunny HQ', $blocksAway));
    }

    /**
     * @param array $directions
     *
     * @return number
     */
    public function followDirections($directions)
    {
        $cords  = [0, 0];
        $facing = 'n';

        foreach ($directions as $direction) {
            // Split direction into needed parts.
            $turn     = $direction[0];
            $distance = (int) substr($direction, 1);

            // Follow the turn/distance given
            $this->follow($cords, $facing, $turn, $distance);
            // Update facing based on which direction we turned
            //$facing = $this->getFacing($facing, $turn);
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
}

<?php

namespace Advent;

use DataLoader;

// Step 1: 122799 is too low.
// Step 2: 137896 is correct.  Found that the char sorting was sorting by count, but not by the keys correctly.
//   xmtjbzidx-xviyt-yzqzgjkhzio-187[yzfeu] is an example where the sorting failed, putting x as the highest of the '3' sets.
//   The room in general is not valid, but it's still not sorted correctly:
//   122 => 4
//   120 => 3
//   105 => 3
//   106 => 2
//   116 => 2
//   etc...

// Step 2: northpole object storage - 501 is the correct room
class RealRooms
{
    /**
     * @var string
     */
    private $dataFile = 'realRooms.txt';

    /**
     * @var string[]
     */
    private $realRooms = [];

    /**
     * @var int
     */
    private $sectorSum = 0;

    /**
     * List of rooms that have keywords.
     *
     * @var array
     */
    private $shortRoomList = [];

    /**
     * Display the Advent Day's work.
     *
     * @return void
     */
    public function display()
    {
        $rooms = DataLoader::loadFileAsArrayData($this->dataFile);

        // Step 1
        $sectorSum1 = $this->findRealRooms($rooms);
        echo (sprintf('Real Room sector sum is %d', $sectorSum1) . "\n\n");

        // Step 2
        echo ("Decoded real rooms:\n");
        echo ("Short List:\n");
        foreach ($this->shortRoomList as $room) {
            echo ($room . "\n");
        }

        echo ("\nFull List:\n");
        foreach ($this->realRooms as $room) {
            echo ($room . "\n");
        }
    }

    /**
     * Iterate over all the rooms and total up the sector totals.
     *
     * @param string[] $rooms
     *
     * @return int
     */
    public function findRealRooms($rooms)
    {
        foreach ($rooms as $room) {
            $this->sectorSum += $this->processRoom($room);
        }

        return $this->sectorSum;
    }

    /**
     * Break up the full room name into it's parts.
     *   Should return the room sector if it's valid, or 0 if it's not.
     *
     * @param string $room
     *
     * @return int
     */
    private function processRoom($room)
    {
        // Create base parts
        $roomParts  = explode('-', $room);
        $roomInfo   = explode('[', array_pop($roomParts));
        $roomName   = implode($roomParts);
        $roomSector = intval($roomInfo[0]);
        $roomCheck  = str_replace(']', '', $roomInfo[1]);

        // Pass the sector if the room is valid.
        if ($this->isValidRoomName($roomName, $roomCheck)) {
            // Decode room and store in a list.
            $room = $this->decodeRoom($roomParts, $roomSector);
            $this->realRooms[] = $room;

            if (false !== strpos($room, 'north')) {
                $this->shortRoomList[] = $room;
            }

            return $roomSector;
        }

        return 0;
    }

    /**
     * Check the room characters vs the room check
     *
     * @param string $roomName
     * @param string $roomCheck
     *
     * @return bool
     */
    private function isValidRoomName($roomName, $roomCheck)
    {
        // Count room name
        $nameInfo = count_chars($roomName, 1);

        // Get only the top 5 characters
        arsort($nameInfo);
        $topChars = $this->getTopChars($nameInfo);
        //$topChars = array_slice($nameInfo, 0, 5, true);  // Old way, not sorted correctly.

        // Confirm the room check
        foreach ($topChars as $char => $count) {
            $char = chr($char);

            if (false === strpos($roomCheck, $char)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Make sure to sort the characters by both their count AND what char they represent.
     *
     * @param array $allChars
     *
     * @return array
     */
    private function getTopChars($allChars)
    {
        $topChars = [];
        $counts   = array_unique($allChars);

        foreach ($counts as $count) {
            $a = [];

            foreach ($allChars as $char => $charCount) {
                if ($count === $charCount) {
                    $a[$char] = $charCount;
                }
            }

            ksort($a);

            foreach ($a as $key => $charCount) {
                $topChars[$key] = $charCount;
            }
        }

        return array_slice($topChars, 0, 5, true);
    }

    /**
     * Decode each room using a shift cipher.
     *   Use roomCheck as the number of times to shift up a given character.
     *
     * @param string[] $roomNameParts
     * @param int      $roomSector
     *
     * @return string
     */
    private function decodeRoom($roomNameParts, $roomSector)
    {
        // We don't have to cycle through the entire amount of the checksum.
        $inc   = $roomSector % 26;
        $chars = range('a', 'z');
        $room  = [];

        // Decode each part separately then put back together.
        foreach ($roomNameParts as $part) {
            $word = [];

            for ($i = 0; $i < strlen($part); $i++) {
                $charPos = array_search($part[$i], $chars) + $inc;

                // If higher than the full alphabet, start back at the beginning.
                if ($charPos > 25) {
                    $charPos -= 26;
                }

                $word[] = $chars[$charPos];
            }

            $room[] = implode($word);
        }

        $room = implode(" ", $room);

        return sprintf('%s - %d', $room, $roomSector);
    }

}

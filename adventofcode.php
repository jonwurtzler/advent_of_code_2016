<?php
/**
 * Advent of Code 2016 - http://adventofcode.com/2016
 *
 * Usage: php adventofcode.php
 *
 * @author Jon Wurtzler <jon.wurtzler@gmail.com>
 * @date 01/04/2017
 */

use Advent\BathroomCodes;
use Advent\BunnyHQ;
use Advent\RealRooms;
use Advent\RepetitionCodes;
use Advent\SecurityCode;
use Advent\ValidDesigns;

require_once __DIR__ . '/vendor/autoload.php';

$adventString = (string) isset($argv[1]) ? $argv[1] : "";
$adventDay    = null;

switch ($adventString) {
    case 'bunny_hq':
        $adventDay = new BunnyHQ();
        break;

    case 'bathroom_code':
        $adventDay = new BathroomCodes();
        break;

    case 'valid_design':
        $adventDay = new ValidDesigns();
        break;

    case 'real_room':
        $adventDay = new RealRooms();
        break;

    case 'security_door':
        $adventDay = new SecurityCode();
        break;

    case 'repetition_code':
        $adventDay = new RepetitionCodes();
        break;

}

if (!is_null($adventDay)) {
  $adventDay->display();
} else {
  echo ("Invalid option, please try again\n");
}

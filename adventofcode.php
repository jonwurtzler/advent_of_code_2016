<?php
/**
 * Advent of Code 2016 - http://adventofcode.com/2016
 *
 * Usage: php adventofcode.php
 *
 * @author Jon Wurtzler <jon.wurtzler@gmail.com>
 * @date 01/04/2017
 */

use Advent\AdventCoinMining;
use Advent\AuntSue;
use Advent\ChristmasRPG;
use Advent\CookieRecipe;
use Advent\ElfAccounting;
use Advent\InfiniteElves;
use Advent\LightsAlive;
use Advent\LookAndSay;
use Advent\NaughtyNiceList;
use Advent\ReindeerMedicine;
use Advent\ReindeerOlympics;
use Advent\SantaDeliveries;
use Advent\SantasPassword;
use Advent\SleighBalance;
use Advent\StairClimber;
use Advent\TuringLock;
use Advent\WizardSimulator;
use Advent\WrappingNeeds;
use Advent\YardGif;

require_once __DIR__ . '/vendor/autoload.php';

$adventString = (string) isset($argv[1]) ? $argv[1] : "";
$adventDay    = null;

switch ($adventString) {
}

if (!is_null($adventDay)) {
  $adventDay->display();
} else {
  echo ("Invalid option, please try again\n");
}

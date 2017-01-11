<?php
use Advent\RepetitionCodes;

/**
 * RepetitionCodesTest -
 *
 */
class RepetitionCodesTest extends PHPUnit_Framework_TestCase
{
    // TC comes from the website examples. (TC = Test Case)
    public function testRepetitionCodeMostTC1()
    {
        $repetitionCodes = new RepetitionCodes();
        $this->assertEquals('easter', $repetitionCodes->findCode([
            'eedadn', 'drvtee', 'eandsr', 'raavrd', 'atevrs',
            'tsrnev', 'sdttsa', 'rasrtv', 'nssdts', 'ntnada',
            'svetve', 'tesnvt', 'vntsnd', 'vrdear', 'dvrsen',
            'enarar',
        ]));
    }

    // TC comes from the website examples. (TC = Test Case)
    public function testRepetitionCodeLeastTC2()
    {
        $repetitionCodes = new RepetitionCodes();
        $this->assertEquals('advent', $repetitionCodes->findCode([
            'eedadn', 'drvtee', 'eandsr', 'raavrd', 'atevrs',
            'tsrnev', 'sdttsa', 'rasrtv', 'nssdts', 'ntnada',
            'svetve', 'tesnvt', 'vntsnd', 'vrdear', 'dvrsen',
            'enarar',
        ], true));
    }
}

<?php

use PHPUnit\Framework\TestCase;
require_once __DIR__."/../day17_1.php";
require_once __DIR__."/../day19_1.php";

class SimpleTest extends TestCase
{
    /**
     * @test
     * @dataProvider catProvider
     */
    public function testCats($expected, $number)
    {
        $this->assertEquals($expected, \day17\num2str($number));
    }

    public function catProvider()
    {
        return [
            ["ноль котиков не знают php", 0],
            ["сто пятьдесят котиков не знают php", 150],
            ["одна тысяча двести три котика не знают php", 1203],
            ["две тысячи пятьсот сорок один котик не знают php", 2541],
            ["сто тысяч котиков не знают php", 100000]
        ];
    }

    /**
     * @test
     * @dataProvider arrayProvider
     */
    public function testArray($array, $values, $expected){
        $this->assertEquals($expected, \day19\checkArray($array, $values));
    }

    public function arrayProvider()
    {
        return [
            [[18,31,24,12,45,13,41], [13,41], true],
            [[18,31,24,12,45,13,41], [14,41], false],
            [[18], [14,41], false],
            [[18], [14], false],
            [[18], [14,18], false]
        ];
    }
}
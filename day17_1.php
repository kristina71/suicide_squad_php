<?php

error_reporting(0);
function num2str($num)
{
    $nul = 'ноль';
    $ten = array(
        array('', 'один', 'два', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять'),
        array('', 'одна', 'две', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять')
    );
    $a20 = array('десять', 'одиннадцать', 'двенадцать', 'тринадцать', 'четырнадцать', 'пятнадцать', 'шестнадцать', 'семнадцать', 'восемнадцать', 'девятнадцать');
    $tens = array(2 => 'двадцать', 'тридцать', 'сорок', 'пятьдесят', 'шестьдесят', 'семьдесят', 'восемьдесят', 'девяносто');
    $hundred = array('', 'сто', 'двести', 'триста', 'четыреста', 'пятьсот', 'шестьсот', 'семьсот', 'восемьсот', 'девятьсот');
    $unit = array(
        array('не знают php',  'не знают php','не знают php',   0),
        array('котик',    'котика',     'котиков',     0),
        array('тысяча',   'тысячи',    'тысяч',      1),
        array('миллион',  'миллиона',  'миллионов',  0),
        array('миллиард', 'миллиарда', 'миллиардов', 0),
    );

    list($cat, $php) = explode(' ', sprintf("%015.2f", floatval($num)));
    $out = array();
    if (intval($cat) > 0) {
        foreach (str_split($cat, 3) as $uk => $v) {
            if (!intval($v)) continue;
            $uk = sizeof($unit) - $uk -1;
            $gender = $unit[$uk][3];

            list($i1, $i2, $i3) = array_map('intval', str_split($v, 1));
            // mega-logic
            $out[] = $hundred[$i1]; // 1xx-9xx
            if ($i2 > 1) $out[] = $tens[$i2] . ' ' . $ten[$gender][$i3]; // 20-99
            else $out[] = $i2 > 0 ? $a20[$i3] : $ten[$gender][$i3]; // 10-19 | 1-9
            // units without cat & kop
            if ($uk > 1) $out[] = morph($v, $unit[$uk][0], $unit[$uk][1], $unit[$uk][2]);
        }
    } else {
        $out[] = $nul;
    }
    $out[] = morph(intval($cat), $unit[1][0], $unit[1][1], $unit[1][2]); // cat
    $out[] = $php . ' ' . morph($php, $unit[0][0], $unit[0][1], $unit[0][2]);

    return trim(preg_replace('/ {2,}/', ' ', join(' ', $out)));
}


function morph($n, $f1, $f2, $f5)
{
    $n = abs(intval($n)) % 100;
    if ($n > 10 && $n < 20) return $f5;
    $n = $n % 10;
    if ($n > 1 && $n < 5) return $f2;
    if ($n == 1) return $f1;
    return $f5;
}

echo num2str(0) . "<br>";      // ноль котиков
echo num2str(150) . "<br>"; // сто пятьдесят котиков
echo num2str(1203) . "<br>";   // одна тысяча двести три котика
echo num2str(2541) . "<br>";   // две тысячи пятьсот сорок один котик
echo num2str(100000); // сто тысяч котиков
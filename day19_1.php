<?php
namespace day19;

$array=[18,31,24,12,45,13,41];
$values=[13,41];


function checkArray(Array $array, Array $values){
    checkArrayFormat($values);
    checkArrayFormat($array);

    foreach ($values as $value) {
        if (array_search($value,$array)) {
            continue;
        }
        else return false;
    }
    return true;
}

function checkArrayFormat(Array $array){
    foreach ($array as $k=>$val){
        if (empty($val) || (!is_numeric($val)))
            unset($array[$k]);
    }
    if (empty($array))
        throw new Exception("Empty array");

    return $array;
}

echo checkArray($array, $values);

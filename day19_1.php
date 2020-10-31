<?php
namespace day19;
require __DIR__.'/exceptions/BadSumException.php';
require __DIR__.'/exceptions/BadFormatException.php';

$array=[18,31,24,12,45,13,41];
$values=[13,41];

function checkArray(Array $array, Array $values){
    checkArrayFormat($values);
    checkArrayFormat($array);
    $flag=false;

    foreach ($values as $value) {
        if (in_array($value,$array)) {
            $flag=true;
        }
        else {
            return false;
        }
    }
    return $flag;
}

function checkArrayFormat(Array $array){
    foreach ($array as $k=>$val){
        if (empty($val) || (!is_numeric($val)))
            unset($array[$k]);
    }
    if (empty($array))
        throw new \MyException\BadFormatException("Empty array");

    return $array;
}

echo checkArray($array, $values);

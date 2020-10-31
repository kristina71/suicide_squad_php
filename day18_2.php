<?php
namespace day18;

require __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/exceptions/BadSumException.php';
require_once __DIR__.'/exceptions/BadFormatException.php';

$nominalArray = [100,200, 500, 1000,2000,5000];
$sum = 30000;
$existValues = [100=>3,200=>0,500=>1,2000=>1,5000=>10];
$result = [];

function getNominalAndCount($sum, $nominalArray, &$result, $existValues) {
    checkSum($sum);
    checkArrayFormat($nominalArray);
    $nominalArray=deleteNotUseNominal($nominalArray, $existValues);
    asort($nominalArray);

    echo "<pre>";
    print_r($nominalArray);

    $nominal = array_pop($nominalArray);

    if (!($sum >= $nominal))
        $nominal = array_pop($nominalArray);

    if ($sum % $nominal)
        list($total, $rest) = explode('.', $sum / $nominal);
    else
        $total = $sum / $nominal;

    if (!empty($total))
        array_push($result, [$nominal => $total]);

    if (isset($rest)) {
        $rest = $sum - $total * $nominal;
        getNominalAndCount($rest, $nominalArray, $result, $existValues);
    }
}

function checkArrayFormat($array){
    foreach ($array as $k=>$val){
        if (empty($val) || (!is_numeric($val)))
            unset($array[$k]);
    }
    if (empty($array))
        throw new \MyException\BadFormatException("Bad format exception");

    return $array;
}

function deleteNotUseNominal($nominalArray, $existValues){
    foreach ($nominalArray as $nominalKey => $nominalValue){
        if (!array_key_exists($nominalValue,$existValues) || empty($existValues[$nominalValue]))
            unset($nominalArray[$nominalKey]);
    }
    sort($nominalArray);
    return $nominalArray;
}

function checkSum($sum){
    if ($sum %100)
        throw new \MyException\BadSumException("Bad sum exception");
}

getNominalAndCount($sum, $nominalArray,$result, $existValues);

print_r($result);
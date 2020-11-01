<?php
namespace day18;

require __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/exceptions/BadSumException.php';
require_once __DIR__.'/exceptions/BadFormatException.php';

/**
 * @param $sum
 * @param $nominalArray
 * @param $result
 * @param $existValues
 * @throws \MyException\BadFormatException
 * @throws \MyException\BadSumException
 */
function getNominalAndCount($sum, $nominalArray, &$result, $existValues) {
    checkSum($sum);
    checkArrayFormat($nominalArray);
    $nominalArray=deleteNotUseNominal($nominalArray, $existValues);
    asort($nominalArray);

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

    return $result;
}

/**
 * @param $array
 * @return mixed
 * @throws \MyException\BadFormatException
 */
function checkArrayFormat($array){
    foreach ($array as $k=>$val){
        if (empty($val) || (!is_numeric($val)))
            unset($array[$k]);
    }
    if (empty($array))
        throw new \MyException\BadFormatException("Bad format exception");

    return $array;
}

/**
 * @param $nominalArray
 * @param $existValues
 * @return mixed
 */
function deleteNotUseNominal($nominalArray, $existValues){
    foreach ($nominalArray as $nominalKey => $nominalValue){
        if (!array_key_exists($nominalValue,$existValues) || empty($existValues[$nominalValue]))
            unset($nominalArray[$nominalKey]);
    }
    sort($nominalArray);
    return $nominalArray;
}

/**
 * @param $sum
 * @throws \MyException\BadSumException
 */
function checkSum($sum){
    if ($sum %100)
        throw new \MyException\BadSumException("Bad sum exception");
}
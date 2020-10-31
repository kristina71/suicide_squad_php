<?php
namespace day18;

$nominalArray = [100,200, 5000, 1000,2000,500];
$sum = 1000;
$result = [];

function getNominalAndCount($sum, $nominalArray, &$result) {

        checkArrayFormat($nominalArray);
        asort($nominalArray);

        $nominal = array_pop($nominalArray);

        if (!($sum >= $nominal))
            $nominal = array_pop($nominalArray);

        if ($sum % $nominal)
            list($total, $rest) = explode('.', $sum / $nominal);
        else
            $total = $sum / $nominal;

        array_push($result, [$nominal => $total]);

        if (isset($rest)) {
            $rest = $sum - $total * $nominal;
            getNominalAndCount($rest, $nominalArray, $result);
        }
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

getNominalAndCount($sum, $nominalArray, $result);

print_r($result);
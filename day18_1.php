<?php
namespace day18;

/**
 * @param $sum
 * @param $nominalArray
 * @param $result
 * @throws \MyException\BadFormatException
 */
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

/**
 * @param array $array
 * @return array
 */
function checkArrayFormat(Array $array){
    foreach ($array as $k=>$val){
        if (empty($val) || (!is_numeric($val)))
            unset($array[$k]);
    }
    if (empty($array))
        throw new Exception("Empty array");

    return $array;
}
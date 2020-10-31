<?php
$nominalArray = [100,200, 500, 1000,2000,5000];
$sum = 17300;
$result = [];

function getNominalAndCount($sum, $nominalArray, &$result) {

    $nominal = array_pop($nominalArray);

    if(!($sum >= $nominal))
        $nominal = array_pop($nominalArray);

    if( $sum % $nominal )
        list($total, $rest) = explode('.', $sum / $nominal);
    else
        $total = $sum / $nominal;


    array_push($result, [$nominal => $total]);

    if(isset($rest)) {
        $rest = $sum - $total * $nominal;
        getNominalAndCount($rest, $nominalArray, $result);
    }
}

getNominalAndCount($sum, $nominalArray, $result);

print_r($result);
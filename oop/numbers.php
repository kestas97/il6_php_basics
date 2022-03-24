<?php

//echo 'labas';

$array = [1, 12, 23, 94, 83, 3, 34, 6, 9, 5, 34, 56, 94, 45, 6, 7, 45, 43, 92, 3];
$arrayEven = [];
$arrayOdd = [];
$maxEven = 0;
$maxOdd = 0;

foreach ($array as $x){
    if ($x %2 == 0){
        $arrayEven[] = $x;
        if ($x > $maxEven){
            $maxEven = $x;
        }
    }else{

        $arrayOdd[] = $x;
        if ($x > $maxOdd){
            $maxOdd = $x;

        }
    }
}

function calcAvarange($array)
{
    $sum = 0;
    foreach ($array as $x){
        $sum = $sum + $x;
    }
    return $sum / count($array);

}
echo '<pre>';
echo calcAvarange($arrayEven);
echo '<br>';
echo calcAvarange($arrayOdd);
echo '<br>';
echo $maxEven;
echo '<br>';
echo $maxOdd;


//echo(max(array_filter($numbers, function($var){return(!($var & 1));})));
////echo '<pre>';
////print_r($numbers['array']);
//echo '<pre>';
//$numbersMin = array(1, 12, 23, 94, 83, 3, 34, 6, 9, 5, 34, 56, 94, 45, 6, 7, 45, 43, 92, 3);
//
//echo(min(array_filter($numbersMin, function($var){return(!($var & 1));})));




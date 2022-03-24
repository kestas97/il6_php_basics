<?php
//[1, 12, 23, 94, 83, 3, 34, 6, 9, 5, 34, 56, 94, 45, 6, 7, 45, 43, 92, 3,4,93,4,5,87,45,67,89,23,41,43,75]
//
//Rasti skaicius mazesnius uz vidurki bet didesnius uz vidurkio puse. suskaiciuoti, kiek tokiu skaiciu yra..

$array = [1, 12, 23, 94, 83, 3, 34, 6, 9, 5, 34, 56, 94, 45, 6, 7, 45, 43, 92, 3,4,93,4,5,87,45,67,89,23,41,43,75];
$sum = 0;

foreach ($array as $x)
{
   // $sum = $sum + $x;
    $sum += $x;

}

$avarange = $sum/count($array);
$i = 0;

foreach ($array as $x)
{
    if ($x <= $avarange && $x >= $avarange/2){

       // $i = $i + 1;
        $i++;

    }
}

echo $i;

//function calcAvarange($array)
//{
//    $sum = 0;
//    foreach ($array as $x){
//        $sum = $sum + $x;
//    }
//    return $sum / count($array);
//
//}
//
//
//echo calcAvarange($array);
//
//echo '<pre>';
//
//$average = array_sum($array) / count($array);
//
//echo $average;
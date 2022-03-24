<?php

namespace Helper;

class CsvParser {
    public static function parseCsv($csv){
        if (($handle = fopen($csv, "r")) !== FALSE) {
            $row = 1;
            $keys = [];
            $adsArray = [];
            while (($data = fgetcsv($handle, 1000)) !== FALSE) {
                if ($row == 1) {
                    $keys = $data;
                } else {
                    $adsArray[$row] = [];
                    foreach ($data as $key => $element) {
                        $adsArray[$row][$keys[$key]] = $element;
                    }
                }
                $row++;
            }
            return $adsArray;
        }else{
            return false;
        }
    }

    public static function createCsv($csv, $array)
    {
        $file = fopen($csv, 'a');
        $header = [];
        foreach ($array[0] as $key => $value){
            $header[] = $key;
        }
        fputcsv($file, $header);
        foreach ($array as $element){
            fputcsv($file, $element);
        }

    }
}

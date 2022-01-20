<?php

function clearEmail($email){
    return trim(strtolower($email));
}
function isEmailValid($email){
    return strpos($email, '@') !== false;
}
function isPasswordValid($pass1, $pass2){
    return $pass1 === $pass2 && strlen($pass1) > 8;
}
function writeToCsv($data, $fileName){
    $file = fopen($fileName, 'a');
    foreach ($data as $element){
        fputcsv($file, $element);
    }
    fclose($file);
}


function isValueUniq($value, $key){
    $users = readFromCsv('users.csv');
    foreach ($users as $user){
        if ($user[$key] === $value){
            return false;
        }
    }
    return true;
}

function readFromCsv($fileName){
    $data = [];
    $file = fopen($fileName, 'r');
    while(!feof($file)){
        $line = fgetcsv($file);
        if (!empty($line)){
            $data[] = $line;
        }
    }
    fclose($file);
    return $data;
}

function generateNick($first, $last){
    return strtolower($first.$last.rand(1, 8));

}






<?php
//funkcija isivalyti emaila
function clearEmail($email){
    return trim(strtolower($email));
}
//patikrinau ar emailas validus
function isEmailValid($email){
    return strpos($email, '@') !== false;
}
//pasitikrinau ar passwordas valydus ir pass1 = pass2
function isPasswordValid($pass1, $pass2){
    return $pass1 === $pass2 && strlen($pass1) > 8;
}
//funkcija, kad rasytu i csv
function writeToCsv($data, $fileName){
    $file = fopen($fileName, 'a');
    foreach ($data as $element){
        fputcsv($file, $element);
    }
    fclose($file);
}

//pasitikrinau ar useriai unikalus
function isValueUniq($value, $key){
    $users = readFromCsv('users.csv');
    foreach ($users as $user){
        if ($user[$key] === $value){
            return false;
        }
    }
    return true;
}
//skaityti is csv
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
//generuoti nick name
function generateNick($first, $last){
    return strtolower($first.$last.rand(1, 8));

}






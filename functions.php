<?php

$name = 'Arnoldas';
$surname = 'Turulis';

// arntur;


function getNickName($name, $surname){
    $firstNameLetters = substr($name, 0, 3);
    $firstsurnNameLetters = substr($surname, 0, 3);
    return $firstNameLetters.$firstsurnNameLetters;
}

echo getNickName($name, $surname);

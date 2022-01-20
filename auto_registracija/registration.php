<?php
include "helper.php";
//apsirasiau kintamuosius
$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password1'];
$password2 = $_POST['password2'];
$carNumber = $_POST['car_number'];
$email = clearEmail($email);

//echo $firstName.$lastName.$email.$password.$password2.$carNumber;
//tikrinau su if ar emailai unikalus, tada passwordai ar emailai validus (nelabai supratau)
if( isValueUniq($email, 2) &&
    isPasswordValid($password, $password2) &&
    isEmailValid($email)
){ //uz šifravau slaptazodzius
    $password = md5($password).'druska';
    $password = md5($password);
    $nickName = generateNick($firstName, $lastName);

//tada paiimiau data ir rasiau i csv.
$data = [];

$data [] = [$firstName, $lastName, $email, $password, $carNumber, $nickName];
writeToCsv($data, 'users.csv');
echo 'sekminga registracija';
}else{
    echo 'patikrink emaila';
}






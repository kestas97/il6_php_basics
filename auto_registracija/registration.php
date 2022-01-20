<?php
include "helper.php";
$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password1'];
$password2 = $_POST['password2'];
$carNumber = $_POST['car_number'];
$email = clearEmail($email);

//echo $firstName.$lastName.$email.$password.$password2.$carNumber;

if( isValueUniq($email, 2) &&
    isPasswordValid($password, $password2) &&
    isEmailValid($email)
){
    $password = md5($password).'druska';
    $password = md5($password);
    $nickName = generateNick($firstName, $lastName);


$data = [];

$data [] = [$firstName, $lastName, $email, $password, $carNumber, $nickName];
writeToCsv($data, 'users.csv');
echo 'sekminga registracija';
}else{
    echo 'patikrink emaila';
}






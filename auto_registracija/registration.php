<?php
include "helper.php";
$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password1'];
$password2 = $_POST['password2'];
$carNumber = $_POST['car_number'];
$email = clearEmail($email);

if(
    isPasswordValid($password, $password2) &&
    isEmailValid($email)


);

$data = [];

$data [] = [$firstName, $lastName, $email, $password, $carNumber];
writeToCsv($data, 'users.csv');

print_r($_POST);




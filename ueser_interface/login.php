<?php
include 'helper.php';

$email = $_POST['email'];
$password = $_POST['password'];

$email = clearEmail($email);
$password = hashPassword($password);

$users = readFromCsv('users.csv');


$login = false;
foreach ($users as $user){


    if($password === $user[4] && $email === $user[2]){
        $login = true;
        break;
    }
}


if($login){
    echo 'prisijungete';
}else{
    echo 'wrong email';
};



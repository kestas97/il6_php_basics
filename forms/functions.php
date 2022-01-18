<?php
//echo "Okey";

//

$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$password = $_POST['password'];
$password2 = $_POST['password2'];

function clearEmail($email){
    $email= strtolower($email);
    return trim($email);
}

function isEmailValid($email){
    if (strpos($email, '@')) {
        return true;
    } else {
        return false;
    }
}

function getNickName($name, $lastname){
    return trim(strtolower(substr($name, 0, 3) . substr($lastname, 0, 3)) . rand(1, 100));
}

function isPasswordValid($password, $password2){
    if (strlen($password) > 5) {
        return true;
    } else {
        echo 'Pasword must be at least 6 charecter long';
    }
}

function register($name, $surname, $email, $password, $password2){
    if (isEmailValid(clearEmail($email))) {
        if (isPasswordValid($password, $password2)) {
            echo 'Welcome' . $name . " " . $surname;
            echo "<br>" . "Your email is: " . $email;
            echo "<br>" . "Your Username is" . getNickName($name, $surname);
        }
    }
}

register($name, $surname, $email, $password, $password2);


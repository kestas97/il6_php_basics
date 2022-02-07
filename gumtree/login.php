<?php

$email = $_POST['email'];
$userPassword = $_POST['password'];

$servername = "localhost";
$username = "root";
$password = "";
$dbName = 'auto_plus';
try {
    $conn = new PDO("mysql:host=$servername;dbname=".$dbName, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$sql = 'SELECT * FROM users WHERE email =" '.$email.'" AND password ="'.$userPassword.'"';
$rez = $conn->query($sql);
$user = $rez->fetchAll();
if(!empty($user)){

}else{
    return 'Pasitikrinkite duomenis';
}

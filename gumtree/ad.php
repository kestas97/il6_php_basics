<?php include 'parts/header.php';
$id = $_GET['id'];

$servername = "localhost";
$username = "root";
$password = "";
$dbName = "auto_plus";

try {
$conn = new PDO("mysql:host=$servername;dbname=" . $dbName, $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
echo "Connection failed: " . $e->getMessage();
}
$sql = 'SELECT * FROM ads WHERE id =  '.$id;
$rez = $conn->query($sql);
$ads = $rez->fetchAll();


echo '<div class="wrapper">';
    foreach($ads as $ad) {
    echo '<div class="content-box">';
        echo '<h3>' . $ad["title"] .'</h3>';
        echo '<p>Price: '. $ad["price"] .'$</p>';
        echo '<p>Years: '. $ad["years"] .'</p>';
        echo '<p>About: '. $ad["desccription"] .'</p>';
        //echo '<p>Owner: '. $ad["name"] .'</p>';
        //echo '<p>Contact phone: '. $ad["phone"] .'</p>';
       // echo '<p>Email phone: '. $ad["email"] .'</p>';
        echo '</div>';
    }
    echo '</div>';
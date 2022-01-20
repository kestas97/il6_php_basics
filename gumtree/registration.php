<?php include 'parts/header.php'; ?>
<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbName = 'auto_plus';

try {
    //mysql:host=localhost;dbname=shop_lt
    $conn = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$sql = 'SELECT * FROM cities';
$rez = $conn->query($sql);
$cities = $rez->fetchAll();



?>

    <form action="submitaduser.php" method="post">
        <input name="name" type="text"><br>
        <input name="email" type="email"><br>
        <input name="phone" type="text"><br>
        <input name="password" type="password"><br>
        <select name="city">
            <?php foreach ($cities as $city){
                echo '<option value="'.$city['id'].'">'.$city['name'].'</option>';
            } ?>
        </select>
    </form>
<?php include 'parts/footer.php'; ?>


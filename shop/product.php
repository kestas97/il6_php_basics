<?php
include 'helper.php';
$id = $_GET['id'];
$product = getProductById($id);

$array = [];
$array[] = 12;
$array[] = 13;


?>

<div class="title">
    <?php echo $product['name']; ?>
</div>
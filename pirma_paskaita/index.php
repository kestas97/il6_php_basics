<?php
//stringai
//$string = 'Hello world2';
//$productName = 'Rudeniniai bata';
//$productdescription = 'Lorem ipsum aprasymas produkto apie batus blaaaaa bla blaa';
//$productBrand = "Nike";
//$symbol = '@';
//$number = '1';
//
////nullas
//$null = null;
//
////integeriai
//$integer = 2;
//$integer1 = 123;
//$integer2 = 1235;
//
//$productQty = 4;
//$holeCount = 32;
//$productManufacturerYears = 1997;
//
////floatai
//$productPrice = 99.99;
//$size = 42;
//$wheit = 1.230;
//
////boolean
//$isInStock = true;
//$waterProof = true;
//$airless = false;
//
////Array
//$product = [
//    'name' => $productName,
//    'qty' => $productQty,
//    'price' => $productPrice,
//    'water_proof' => $waterProof
//];
//$product2 = [
//    'name' => 'Vasariniai batai',
//    'qty' => 5,
//    'price' => 51.55,
//    'water_proof' => true
//];
//
//$products = [$product, $product2];
//
//echo '<pre>';
//
//
////print_r($products);
////echo $product['name'];
////echo $product['price'];
////echo '<br>';
////echo $product2['name'];
////echo $product2['price'];
////echo $productdescription;
////echo '<br>';
////echo $productBrand;
//$pvm = 21;
//
//$priceWithTax = $productPrice * (1+($pvm / 100));
//
//echo $priceWithTax;

//
//$x = 1;
//$y = ['2', $x];
//echo '<pre>';
//var_dump($y);

//

////$x = 5;
////$y = 3;
////
////if($x === 2){
////    echo 'true';
////} else {
////    echo 'false';
//}

//if(!$variable){
// $variable = 2;
//
//}
//
//echo $variable;


$products = [
    [
        'name' => "Siulai",
        'price' => "12.4",
        'img' => ''
    ],
    [
        'name' => 'adata',
        'price' => '1.99',
        'img' => ''
    ],
    [
    'name' => 'virbalas',
    'price' => '100',
    'img' => ''
    ],
    [
        'name' => "Siulai",
        'price' => "12.4",
        'img' => ''
    ],
    [
        'name' => 'adata',
        'price' => '1.99',
        'img' => ''
    ],
    [
        'name' => 'virbalas',
        'price' => '100',
        'img' => ''
    ],
    [
        'name' => "Siulai",
        'price' => "12.4",
        'img' => ''
    ],
    [
        'name' => 'adata',
        'price' => '1.99',
        'img' => ''
    ],
    [
        'name' => 'virbalas',
        'price' => '100',
        'img' => ''
    ]

];
$counter = 0;
foreach($products as $product){
    echo '<h2>'. $product["name"] . '</h2>';
    echo '<img width="60" src="' . $product['img'] . '" />';
    echo '<h3>'. $product["price"] . '</h3>';
    if ($counter % 3 === 0){
        echo '<hr>';
    }
    echo '<hr>';
    //$counter = $counter +1;
    $counter++;
}

echo $counter;

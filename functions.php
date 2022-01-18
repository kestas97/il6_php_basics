<?php


$products = [
    [
        'name' => 'Siulai',
        'price' => 12.4,
        'img' => 'https://siulupinkles.lt/wp-content/uploads/2021/01/Mezgimo-siulai-ritese-italiski-siulai-kasmyras-kasmyro-siulai-silko-siulai-silkas.jpg'
    ],

    [
        'name' => 'virbalai',
        'price' => 2.50,
        'img' => 'https://www.siltassiulas.lt/images/uploader/kn/knitpro-nova-cubics-ilgi-virbalai-35-cm-600-mm-1.jpg'
    ],

    [
    'name' => 'adatos',
    'price' => 1.90,
        'special_price' => 0.50,
    'img' => 'http://www.siuvimoreikmenys.lt/upl/Image/Ivairus/apie-adatas.jpg'
    ],

    [
    'name' => 'Siulai',
    'price' => 12.4,
    'img' => 'https://siulupinkles.lt/wp-content/uploads/2021/01/Mezgimo-siulai-ritese-italiski-siulai-kasmyras-kasmyro-siulai-silko-siulai-silkas.jpg'
    ],

    [
        'name' => 'virbalai',
        'price' => 2.50,
        'img' => 'https://www.siltassiulas.lt/images/uploader/kn/knitpro-nova-cubics-ilgi-virbalai-35-cm-600-mm-1.jpg'
    ],

    [
        'name' => 'adatos',
        'price' => 1.90,
        'img' => 'http://www.siuvimoreikmenys.lt/upl/Image/Ivairus/apie-adatas.jpg'
    ],

    [
        'name' => 'Siulai',
        'price' => 12.4,
        'special_price' => 5.99,
        'img' => 'https://siulupinkles.lt/wp-content/uploads/2021/01/Mezgimo-siulai-ritese-italiski-siulai-kasmyras-kasmyro-siulai-silko-siulai-silkas.jpg'
    ],

    [
        'name' => 'virbalai',
        'price' => 2.50,
        'img' => 'https://www.siltassiulas.lt/images/uploader/kn/knitpro-nova-cubics-ilgi-virbalai-35-cm-600-mm-1.jpg'
    ],

    [
        'name' => 'adatos',
        'price' => 1.90,
        'img' => 'http://www.siuvimoreikmenys.lt/upl/Image/Ivairus/apie-adatas.jpg'
    ],

    ];


$counter = 0;

foreach($products as $product) {
        echo '<img width="60" src="' . $product['img'] . '" />';
        echo '<h2>' . $product["name"] . '</h2>';
        if(isset($product['special_price'])){
            echo '<del>' .$product['special_price']. '</del>' .$product['price'];
        }else {
            echo $product['price'];

        }
        echo '<h3>' . $product["price"] . '</h3>';
        //$counter++;
        //if ($counter % 3 == 0)
            echo '<hr>';


}
echo $counter;

<?php

const URL = 'http://localhost/pamokos/shop/';
// http://127.0.0.1:8000/product.php?id=6
function readFromCsv($fileName)
{
    $data = [];
    $file = fopen($fileName, 'r');
    while (!feof($file)) {
        $line = fgetcsv($file);
        if (!empty($line)) {
            $data[] = $line;
        }
    }
    fclose($file);
    return $data;

}

function writeToCsv($data, $fileName)
{
    $file = fopen($fileName, 'a');
    foreach ($data as $element) {
        fputcsv($file, $element);
    }
    fclose($file);
}

function debug($data)
{
    echo '<pre>';
    var_dump($data);
    die();
}

function prepearProducts($products)
{
    $header = $products[0];
    unset($products[0]);
    $data = [];
    foreach ($products as $product) {
        $data[] = [
            $header[0] => $product[0],
            $header[1] => $product[1],
            $header[2] => $product[2],
            $header[3] => $product[3],
            $header[4] => $product[4],
        ];
    }

    return $data;
}

function getProductUrl($id)
{
    return URL . 'product.php?id=' . $id;
}

function getProductById($id)
{
    $products = readFromCsv('product.csv');
    $products = prepearProducts($products);
    foreach ($products as $product) {
        if ($product['id'] == $id) {
            return $product;
        }
    }

    return null;
}

<?php

namespace Controller;
use Helper\FormHelper;
use Model\Url;
use Model\Ads;
class Catalog
{
    public function show($id)
    {
            echo 'Catalog controller ID ' . $id;

    }

    public function all($id)
    {
        for($i = 0; $i < 10; $i++){
            echo '<a href="http://localhost/pamokos/oop//index.php/catalog/show/'.$i.'">Read more</a>';
            echo '<br>';
        }
    }

    public function create()
    {

        if (!isset($_SESSION["user_id"])){
            Url::redirect("user/login");
        }
        $form = new FormHelper("catalog/insert", "POST");

        $form->input([
            'name'=> 'title',
            'type' => 'text',
            'placeholder' => 'Title'
        ]);
        $form->textArea("description", "Description");

        $form->input([
            'name'=> 'price',
            'type'=> 'text',
            'placeholder'=>'Eur'

        ]);

        $years = [];
        for($x = 1990; $x <= date("Y"); $x++) {
            $years[$x] = $x;
        }

        $form->select([
            'name'=> 'years',
            'type'=> $years
        ]);

        $form->input([
            'name'=> 'submit',
            'type'=> 'submit',
            'placeholder'=> 'Prideti'
        ]);

        echo $form->getForm();

    }

    public function insert(){
        if(!isset($_SESSION['user_id'])){
            Url::redirect("user/login");
        }

        $ad = new Ads();
        $ad->setTitle($_POST["title"]);
        $ad->setDescription($_POST["description"]);
        $ad->setManufacturerId(1);
        $ad->setModelId(1);
        $ad->setPrice($_POST["price"]);
        $ad->setYears($_POST["year"]);
        $ad->setTypeId(1);
        $ad->setUserId($_SESSION["user_id"]);

        $ad->save();
        Url::redirect("catalog/create");
    }

    public function update($data)
    {
        echo 'I\'m Robot';
    }
}
